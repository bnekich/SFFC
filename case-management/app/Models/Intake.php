<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Intake extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'completed_by_id',
        'parent_name',
        'parent_phone',
        'referral_date',
        'referral_contact',
        'case_summary',
        'hasSFFCHistory',
        'do_not_share_list',
        'requesting_host_family',
        'requesting_family_friend',
        'requesting_resource_friend',
        'urgency',
        'expected_support_duration',
        'family_preference',
        'known_risks',
        'child_protective_services_experience',
        'emotional_behavioral_medical_concerns',
        'is_a_sffc_fit',
        'resources_provided',
        'created_by',
        'updated_by',
    ];

    public function person()
    {
        return $this->belongsTo(Person::class);
    }
}
