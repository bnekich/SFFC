<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Elloquent\Relations\BelongsTo;
use Illuminate\Database\Elloquent\Relations\BelongsToMany;
use Illuminate\Database\Elloquent\Relations\HasMany;
use Illuminate\Database\Elloquent\Relations\HasOne;

class Person extends Model
{
    use HasFactory;

    protected $fillable = ['first_name', 'middle_name', 'last_name', 'date_of_birth', 'gender', 'email', 'phone', 'can_text_reminder', 'can_email_reminder', 'person_type', 'created_by', 'updated_by'];

    public function personType()
    {
        return $this->belongsTo(PersonType::class, 'person_type');
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'persons_roles');
    }

    public function families()
    {
        return $this->belongsToMany(Family::class, 'persons_families');
    }

    public function relationships1()
    {
        return $this->hasMany(Relationship::class, 'person_id_1');
    }

    public function relationships2()
    {
        return $this->hasMany(Relationship::class, 'person_id_2');
    }

    public function volunteer()
    {
        return $this->hasOne(Volunteer::class, 'id');
    }

    public function assignedCases()
    {
        return $this->hasMany(CaseModel::class, 'assigned_staff_id');
    }

    public function appointments()
    {
        return $this->belongsToMany(Appointment::class, 'appointments_persons')->withTimestamps()->withPivot('created_by', 'updated_by');
    }

    public function reminders()
    {
        return $this->hasMany(Reminder::class, 'for_person_id');
    }

    public function courses()
    {
        return $this->hasMany(Course::class, 'instructor_id');
    }

    public function organizations()
    {
        return $this->hasMany(Organization::class, 'contact_person_id');
    }
}