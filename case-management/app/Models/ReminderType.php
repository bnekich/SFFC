<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ReminderType extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name'];

    public function reminders()
    {
        return $this->hasMany(Reminder::class, 'reminder_type');
    }
}
