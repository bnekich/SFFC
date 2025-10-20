<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User;
use App\Models\CaseModel;
use App\Models\Person;
use App\Models\Organization;
use App\Models\Volunteer;
use App\Models\Intake;
//use App\Models\Privacy;
//use App\Models\NoteStatus;


class Note extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'note', 'comments', 'privacy_id', 'note_status_id', 'approved', 'created_by', 'updated_by'];

    // public function privacy()
    // {
    //     return $this->belongsTo(Privacy::class);
    // }
    // public function noteStatus()
    // {
    //     return $this->belongsTo(NoteStatus::class);
    // }

    public function createdBy()
    {
        return $this->belongsTo(User::class);
    }
    public function updatedBy()
    {
        return $this->belongsTo(User::class);
    }

    // Define relationships for each noteable type (for targeted access)
    public function cases()
    {
        return $this->morphedByMany(CaseModel::class, 'noteable');
    }

    public function people()
    {
        return $this->morphedByMany(Person::class, 'noteable'); // Assuming Person model for People
    }

    public function organizations()
    {
        return $this->morphedByMany(Organization::class, 'noteable');
    }

    public function volunteers()
    {
        return $this->morphedByMany(Volunteer::class, 'noteable');
    }

    // Add similar methods for Intake, etc.

    // Optional: A method to get all attached noteables (mixed types)
    // public function noteables()
    // {
    //     return $this->morphToMany('noteable', 'noteable'); // But typically, you'd query via specific relations
    // }
}
