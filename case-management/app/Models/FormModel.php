<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FormModel extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'forms';

    public function fields()
    {
        return $this->belongsToMany(Field::class, 'forms_fields');
    }
}
