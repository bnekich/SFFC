<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VolunteerStatus extends Model
{
    use HasFactory;
    protected $table = 'volunteer_statuses';
    protected $fillable = ['name'];
}
