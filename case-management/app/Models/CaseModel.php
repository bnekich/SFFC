<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class CaseModel extends Model
{
    // Named CaseModel to avoid clashes with case keyword in PHP
    use HasFactory, SoftDeletes;

    protected $table = 'cases';
    protected $fillable = ['case_identifier', 'case_description', 'client_family_id', 'host_family_id', 'assigned_staff_id', 'start_date', 'end_date', 'case_status_id', 'created_by', 'updated_by'];

    public function clientFamily()
    {
        return $this->belongsTo(Family::class, 'client_family_id');
    }

    public function hostFamily()
    {
        return $this->belongsTo(Family::class, 'host_family_id');
    }

    public function assignedStaff()
    {
        return $this->belongsTo(Person::class, 'assigned_staff_id');
    }

    public function caseStatus()
    {
        return $this->belongsTo(CaseStatus::class, 'case_status_id');
    }

    public function services()
    {
        return $this->belongsToMany(ServiceModel::class, 'cases_services');
    }

    public function volunteers()
    {
        return $this->belongsToMany(Volunteer::class, 'cases_volunteers');
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class, 'case_id');
    }

    public function notes()
    {
        return $this->morphToMany(Note::class, 'noteable');
    }

    public function caseNotes()
    {
        return $this->hasMany(CaseNote::class, 'case_id');
    }

    public function createdByUser()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
