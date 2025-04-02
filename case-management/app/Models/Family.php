<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Family extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['family_name', 'address_id', 'status_id', 'created_by', 'updated_by'];

    public function persons()
    {
        return $this->belongsToMany(Person::class, 'persons_families');
    }

    public function address()
    {
        return $this->belongsTo(Address::class);
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
    }


    public function clientCases()
    {
        return $this->hasMany(CaseModel::class, 'client_family_id');
    }

    public function hostCases()
    {
        return $this->hasMany(CaseModel::class, 'host_family_id');
    }
}
