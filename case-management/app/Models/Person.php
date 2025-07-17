<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
//use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Permission\Traits\HasRoles;

class Person extends Model
{
    use HasFactory, HasRoles, SoftDeletes;

    protected $table = 'persons';

    protected $fillable = [
        'first_name',
        'middle_name',
        'last_name',
        'date_of_birth',
        'gender',
        'ethnicity',
        'email',
        'phone',
        'address_id',
        'can_text_reminder',
        'can_email_reminder',
        'created_by',
        'updated_by',
    ];


    public function address()
    {
        return $this->belongsTo(Address::class);
    }

    public function families()
    {
        return $this->belongsToMany(Family::class, 'persons_families', 'person_id', 'family_id');
    }

    public function organizations()
    {
        return $this->belongsToMany(Organization::class, 'persons_organizations', 'person_id', 'organization_id')
            ->withTimestamps();
    }

    public function courses()
    {
        return $this->hasMany(Course::class, 'instructor_id');
    }

    public function volunteer()
    {
        return $this->hasOne(Volunteer::class);
    }
}
