<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ServiceModel extends Model
{
    // Named CaseModel to avoid clashes with case keyword in PHP
    use HasFactory, SoftDeletes;

    protected $table = 'services';
    protected $fillable = ['name', 'description', 'provider', 'created_by', 'updated_by'];

    public function cases()
    {
        return $this->belongsToMany(CaseModel::class, 'cases_services');
    }
}
