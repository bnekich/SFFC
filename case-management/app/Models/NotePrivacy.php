<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotePrivacy extends Model
{
    use HasFactory;
    protected $fillable = ['name'];

    public function notes()
    {
        return $this->hasMany(Note::class);
    }
}
