<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReminderType extends Model
{
    use HasFactory;
    protected $fillable = ['name'];

    public function reminders()
    {
        return $this->hasMany(Reminder::class, 'reminder_type');
    }
}
