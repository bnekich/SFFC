<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Volunteer extends Model
{
    protected $fillable = ['training_status', 'availability', 'assignment_date', 'created_by', 'updated_by'];

    public function person()
    {
        return $this->belongsTo(Person::class, 'id');
    }

    public function cases()
    {
        return $this->belongsToMany(CaseModel::class, 'cases_volunteers');
    }

    public function courses()
    {
        return $this->belongsToMany(Course::class, 'volunteers_courses')->withPivot('completed');
    }
}