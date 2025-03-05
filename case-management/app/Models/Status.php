<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Status extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function cases()
    {
        return $this->hasMany(CaseModel::class);
    }

    public function families()
    {
        return $this->hasMany(Family::class);
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }
}
