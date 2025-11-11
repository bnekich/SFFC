<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class FamilyPerson extends Pivot
{
    protected $table = 'family_person';
    public $incrementing = false;

    public function type()
    {
        return $this->belongsTo(RelationshipType::class, 'relationship_type_id');
    }
}
