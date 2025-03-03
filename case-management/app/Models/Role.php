<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Role extends Model
{
    use HasFactory;
    
    protected $fillable = ['name'];

    public function persons()
    {
        return $this->belongsToMany(Person::class, 'persons_roles');
    }
}
