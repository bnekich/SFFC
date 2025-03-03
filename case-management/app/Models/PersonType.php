<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PersonType extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function persons()
    {
        return $this->hasMany(Person::class, 'person_type');
    }
}