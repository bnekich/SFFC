<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Family extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['family_name', 'address_id', 'status_id', 'created_by', 'updated_by'];

    public function members()
    {
        return $this->belongsToMany(Person::class, 'family_person')->withPivot(
            'relationship_type_id',
            'is_primary_contact',
            'joined_at',
            'left_at'
        )
            ->withTimestamps()
            ->using(FamilyPerson::class);
    }

    public function primaryContact()
    {
        return $this->members()
            ->wherePivot('is_primary_contact', true)
            ->first();
    }

    public function address()
    {
        return $this->belongsTo(Address::class);
    }

    public function status()
    {
        return $this->belongsTo(CaseStatus::class);
    }


    public function clientCases()
    {
        return $this->hasMany(CaseModel::class, 'client_family_id');
    }

    public function hostCases()
    {
        return $this->hasMany(CaseModel::class, 'host_family_id');
    }
    public function createdByUser()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
    public function updatedByUser()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
