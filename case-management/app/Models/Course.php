<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Course extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'instructor_id'];

    public function instructor()
    {
        return $this->belongsTo(Person::class, 'instructor_id');
    }

    public function volunteers()
    {
        return $this->belongsToMany(Volunteer::class, 'volunteers_courses')->withPivot('completed');
    }
}