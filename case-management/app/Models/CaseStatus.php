<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CaseStatus extends Model
{
  use HasFactory;

  protected $table = 'case_statuses';
  protected $fillable = ['name'];
}
