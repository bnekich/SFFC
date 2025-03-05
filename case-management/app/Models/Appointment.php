<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = ['case_id', 'description', 'start', 'end', 'location', 'send_reminders', 'status_id', 'created_by', 'updated_by'];

    public function case()
    {
        return $this->belongsTo(CaseModel::class, 'case_id');
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    public function persons()
    {
        return $this->belongsToMany(Person::class, 'appointments_persons')->withTimestamps()->withPivot('created_by', 'updated_by');
    }

    public function reminders()
    {
        return $this->hasMany(Reminder::class);
    }
}
