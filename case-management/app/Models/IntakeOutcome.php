<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IntakeOutcome extends Model
{
  use HasFactory;

  protected $table = 'intake_outcomes';

  protected $fillable = [
    'name'
  ];
}
