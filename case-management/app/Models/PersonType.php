<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class PersonType extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name'];

    public function persons()
    {
        return $this->hasMany(Person::class, 'person_type');
    }
}
