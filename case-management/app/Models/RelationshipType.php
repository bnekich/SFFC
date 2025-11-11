<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RelationshipType extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'inverse_type_id', 'created_by', 'updated_by'];

    public function inverse()
    {
        return $this->belongsTo(self::class, 'inverse_type_id');
    }
}
