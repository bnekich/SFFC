<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Organization extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'organization_type_id',
        'address_id',
        'contact_person_name',
        'contact_person_title',
        'contact_person_email',
        'contact_person_phone',
        'contact_person_mobile',
        'notes',
        'created_by',
        'updated_by'
    ];

    public function persons()
    {
        return $this->belongsToMany(Person::class, 'persons_organizations', 'organization_id', 'person_id')
            ->withTimestamps();
    }

    public function address()
    {
        return $this->belongsTo(Address::class);
    }
    public function organizationType()
    {
        return $this->belongsTo(OrganizationType::class);
    }
    public function volunteers()
    {
        // An organization can have many volunteers.
        return $this->hasMany(Volunteer::class, 'church_id');
    }
}
