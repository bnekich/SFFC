<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Volunteer extends Model
{
    use HasFactory;

    protected $fillable = ['person_id', 'county', 'church_id', 'created_by', 'updated_by'];

    public function person()
    {
        return $this->belongsTo(Person::class, 'id');
    }

    public function cases()
    {
        return $this->belongsToMany(CaseModel::class, 'cases_volunteers');
    }

    public function notes()
    {
        return $this->morphToMany(Note::class, 'noteable');
    }
}
