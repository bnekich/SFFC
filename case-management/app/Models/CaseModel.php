<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CaseModel extends Model
{
    // Named CaseModel to avoid clashes with case keyword in PHP
    use HasFactory;

    protected $table = 'cases';
    protected $fillable = ['case_identifier', 'case_description', 'client_family_id', 'host_family_id', 'assigned_staff_id', 'start_date', 'end_date', 'status_id', 'created_by', 'updated_by'];

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

    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    public function services()
    {
        return $this->belongsToMany(Service::class, 'cases_services');
    }

    public function volunteers()
    {
        return $this->belongsToMany(Volunteer::class, 'cases_volunteers');
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class, 'case_id');
    }
}
