<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Volunteer extends Model
{
    use HasFactory;

    protected $fillable = ['person_id', 'county', 'church_id', 'volunteer_status_id', 'created_by', 'updated_by'];

    public function person()
    {
        return $this->belongsTo(Person::class, 'person_id');
    }

    public function volunteerStatus()
    {
        return $this->belongsTo(VolunteerStatus::class, 'volunteer_status_id');
    }

    public function cases()
    {
        return $this->belongsToMany(CaseModel::class, 'cases_volunteers');
    }

    public function notes()
    {
        return $this->morphToMany(Note::class, 'noteable');
    }

    /**
     * Get the church (organization) that the volunteer belongs to.
     */
    public function church()
    {
        // Note: The foreign key is 'church_id' on the volunteers table.
        return $this->belongsTo(Organization::class, 'church_id');
    }
}
