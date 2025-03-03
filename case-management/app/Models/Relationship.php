<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Relationship extends Model
{
    use HasFactory;

    protected $fillable = ['person_id_1', 'person_id_2', 'relationship_type_id', 'created_by', 'updated_by'];

    public function person1()
    {
        return $this->belongsTo(Person::class, 'person_id_1');
    }

    public function person2()
    {
        return $this->belongsTo(Person::class, 'person_id_2');
    }

    public function relationshipType()
    {
        return $this->belongsTo(RelationshipType::class);
    }
}
