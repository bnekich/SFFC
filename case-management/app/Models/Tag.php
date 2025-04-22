<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = ['name'];

    public function caseNotes()
    {
        return $this->belongsToMany(CaseNote::class, 'case_note_tag', 'tag_id', 'case_note_id');
    }
}
