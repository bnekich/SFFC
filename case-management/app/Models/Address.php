<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Address extends Model
{
    use HasFactory;

    protected $fillable = ['address_line_1', 'address_line_2', 'city', 'state', 'zip', 'created_by', 'updated_by'];

    public function families()
    {
        return $this->hasMany(Family::class, 'address_id');
    }

    public function organizations()
    {
        return $this->hasMany(Organization::class, 'address_id');
    }
}