<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Volunteer extends Model
{
    use HasFactory;

    protected $fillable = ['church_id', 'county', 'person_id', 'volunteer_status_id', 'sffc_chapter_id', 'created_by', 'updated_by'];

    public function cases()
    {
        return $this->belongsToMany(CaseModel::class, 'cases_volunteers');
    }

    public function church()
    {
        return $this->belongsTo(Organization::class, 'church_id');
    }

    public function notes()
    {
        return $this->morphToMany(Note::class, 'noteable');
    }

    public function person()
    {
        return $this->belongsTo(Person::class, 'person_id');
    }

    public function sffc_chapter()
    {
        return $this->belongsTo(Organization::class, 'sffc_chapter_id');
    }

    public function volunteerStatus()
    {
        return $this->belongsTo(VolunteerStatus::class, 'volunteer_status_id');
    }
}
