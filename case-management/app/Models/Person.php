<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
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
        'email',
        'phone',
        'address_id',
        'can_text_reminder',
        'can_email_reminder',
        'created_by',
        'updated_by',
    ];

    public function User(): HasOne
    {
        return $this->hasOne(User::class, 'person_id');
    }

    public function address()
    {
        return $this->belongsTo(Address::class);
    }

    public function families()
    {
        return $this->belongsToMany(Family::class, 'persons_families');
    }

    public function organizations()
    {
        return $this->hasMany(Organization::class, 'contact_person_id');
    }

    public function courses()
    {
        return $this->hasMany(Course::class, 'instructor_id');
    }

    // public function relationships1()
    // {
    //     return $this->hasMany(Relationship::class, 'person_id_1');
    // }

    // public function relationships2()
    // {
    //     return $this->hasMany(Relationship::class, 'person_id_2');
    // }

    // public function volunteer()
    // {
    //     return $this->hasOne(Volunteer::class, 'id');
    // }

    // public function assignedCases()
    // {
    //     return $this->hasMany(CaseModel::class, 'assigned_staff_id');
    // }

    // public function appointments()
    // {
    //     return $this->belongsToMany(Appointment::class, 'appointments_persons')->withTimestamps()->withPivot('created_by', 'updated_by');
    // }

    // public function reminders()
    // {
    //     return $this->hasMany(Reminder::class, 'for_person_id');
    // }


}
