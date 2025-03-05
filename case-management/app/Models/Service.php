<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Service extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'description', 'provider', 'created_by', 'updated_by'];

    public function cases()
    {
        return $this->belongsToMany(CaseModel::class, 'cases_services');
    }
}
