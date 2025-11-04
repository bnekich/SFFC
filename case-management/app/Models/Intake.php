<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Intake extends Model
{
    use HasFactory, SoftDeletes;

    protected $casts = ['created_at' => 'date'];

    protected $fillable = [
        'address_line_1',
        'address_line_2',
        'can_text_reminder',
        'can_email_reminder',
        'child_protective_services_experience',
        'city',
        'completed_by_id',
        'created_by',
        'date_of_birth',
        'do_not_share_list',
        'email',
        'emotional_behavioral_medical_concerns',
        'ethnicity',
        'expected_support_duration',
        'family_preference',
        'first_name',
        'gender',
        'hasSFFCHistory',
        'intake_status_id',
        'is_a_sffc_fit',
        'is_homeless',
        'known_risks',
        'last_name',
        'mobile_phone',
        'number_of_children',
        'organization_id', //SFFC chapter
        'organization_type_id', //how did you hear about us?
        'other_phone',
        'parent_declines_sffc_support',
        'parent_agrees_to_sffc_support',
        'parent_wants_more_info',
        'primary_language_spoken',
        'reason_for_assistance',
        'referral_contact',
        'referral_organization',
        'referral_organization_email',
        'referral_organization_phone',
        'requesting_family_friend',
        'requesting_host_family',
        'requesting_resource_friend',
        'resources_provided',
        'state',
        'updated_by',
        'urgency',
        'zip',
        'address_id'
    ];

    public function status()
    {
        return $this->belongsTo(IntakeStatus::class, 'intake_status_id');
    }

    public function person()
    {
        return $this->belongsTo(Person::class);
    }

    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }
    public function address()
    {
        return $this->belongsTo(Address::class);
    }
}
