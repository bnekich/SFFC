<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IntakeStatus extends Model
{
  use HasFactory;

  protected $table = 'intake_statuses';

  protected $fillable = [
    'name',
  ];
}
