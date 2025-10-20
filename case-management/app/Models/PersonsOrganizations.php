<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PersonsOrganizations extends Model
{
    use HasFactory;

    protected $table = 'persons_organizations';

    protected $fillable = [
        'person_id',
        'organization_id',
    ];
}
