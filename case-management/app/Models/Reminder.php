<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reminder extends Model
{
    use HasFactory;

    protected $fillable = ['appointment_id', 'for_person_id', 'reminder_type', 'reminder_time', 'status', 'created_by', 'updated_by'];

    public function appointment()
    {
        return $this->belongsTo(Appointment::class);
    }

    public function person()
    {
        return $this->belongsTo(Person::class, 'for_person_id');
    }

    public function reminderType()
    {
        return $this->belongsTo(ReminderType::class, 'reminder_type');
    }
}
