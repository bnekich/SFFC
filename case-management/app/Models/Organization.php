<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'address_id', 'contact_person_id', 'created_by', 'updated_by'];

    public function address()
    {
        return $this->belongsTo(Address::class);
    }

    public function contactPerson()
    {
        return $this->belongsTo(Person::class, 'contact_person_id');
    }
}