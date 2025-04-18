<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CaseNote extends Model
{
    /** @use HasFactory<\Database\Factories\CaseNoteFactory> */
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'case_id',
        'subject',
        'note',
        'privacy_level',
        'status',
        'is_approved',
        'tags',
        'created_by',
        'updated_by',
    ];
    protected $casts = [
        'tags' => 'array',
        'is_approved' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];
    protected $hidden = [
        'created_by',
        'updated_by',
        'deleted_at',
    ];
    protected $appends = [
        'created_by_user',
        'updated_by_user',
    ];
    public function getCreatedByUserAttribute()
    {
        return $this->createdBy()->first();
    }
    public function getUpdatedByUserAttribute()
    {
        return $this->updatedBy()->first();
    }
    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
    public function case()
    {
        return $this->belongsTo(CaseModel::class, 'case_id');
    }
}
