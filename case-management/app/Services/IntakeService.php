<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Intake;
use App\Models\Document;
use App\Http\Requests\IntakeFormRequest;
use App\Models\IntakeStatus;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;

class IntakeService
{
    public function getIntakes(array $filters = [], array $sort = []): LengthAwarePaginator
    {
        $query = Intake::query();

        if (!empty($filters['search'])) {
            $search = $filters['search'];
            $query->where(function ($q) use ($search) {
                $q->where('last_name', 'like', "%{$search}%")
                    ->orWhere('reason_for_assistance', 'like', "%{$search}%");
            });
        }

        if (!empty($filters['status'])) {
            $query->where('intake_status_id', $filters['status']);
        }

        $sort['field'] = $sort['field'] ?? 'id';
        $sort['direction'] = $sort['direction'] ?? 'asc';
        $query->orderBy($sort['field'], $sort['direction']);

        return $query->paginate(10);
    }

    public function createIntake(array $data): Intake
    {
        $userId = 1; //default system id
        if (Auth::check()) {
            $userId = auth()->id();
        } else {
            $status = IntakeStatus::where('name', 'New')->get()->first();
            $data['intake_status_id'] = $status->id;
            $data['child_protective_services_experience'] = null;
            $data['do_not_share_list'] = null;
            $data['referral_date'] = null;
            $data['hasSFFCHistory'] = null;
            $data['requesting_resource_friend'] = null;
            $data['do_not_share_list'] = null;
            $data['emotional_behavioral_medical_concerns'] = null;
            $data['expected_support_duration'] = null;
            $data['known_risks'] = null;
            $data['family_preference'] = null;
            $data['is_a_sffc_fit'] = null;
            $data['resources_provided'] = null;
            $data['urgency'] = "Urgent";
        }

        $supportChoices = [
            'parent_declines_sffc_support' => null,
            'parent_agrees_to_sffc_support' => null,
            'parent_wants_more_info'        => null,
        ];

        match ($data['sffc_choice']) {
            'declines'  => $supportChoices['parent_declines_sffc_support'] = true,
            'agrees'    => $supportChoices['parent_agrees_to_sffc_support'] = true,
            'more_info' => $supportChoices['parent_wants_more_info']        = true,
        };

        $serviceChoices = [
            'requesting_host_family' => null,
            'requesting_family_friend' => null,
        ];
        match ($data['requested_service']) {
            'host'  => $serviceChoices['requesting_host_family'] = true,
            'family'    => $serviceChoices['requesting_family_friend'] = true,
        };

        return DB::transaction(function () use ($data, $userId, $supportChoices, $serviceChoices) {
            return Intake::create([
                'first_name' => $data['first_name'],
                'last_name' => $data['last_name'],
                'address_line_1' => $data['address_line_1'],
                'address_line_2' => $data['address_line_2'],
                'can_text_reminder' => $data['can_text_reminder'],
                'can_email_reminder' => $data['can_email_reminder'],
                'child_protective_services_experience' => $data['child_protective_services_experience'],
                'city' => $data['city'],
                'completed_by_id' => $userId,
                'created_by' => $userId,
                'date_of_birth' => $data['date_of_birth'],
                'do_not_share_list' => $data['do_not_share_list'],
                'email' => $data['email'],
                'emotional_behavioral_medical_concerns' => $data['emotional_behavioral_medical_concerns'],
                'ethnicity' => $data['ethnicity'],
                'expected_support_duration' => $data['expected_support_duration'],
                'family_preference' => $data['family_preference'],
                'gender' => $data['gender'],
                'first_name' => $data['first_name'],
                'hasSFFCHistory' => $data['hasSFFCHistory'],
                'intake_status_id' => $data['intake_status_id'],
                'is_a_sffc_fit' => $data['is_a_sffc_fit'],
                'is_homeless' => $data['is_homeless'],
                'known_risks' => $data['known_risks'],
                'mobile_phone' => $data['mobile_phone'],
                'last_name' => $data['last_name'],
                'number_of_children' => $data['number_of_children'],
                'organization_id' => $data['organization_id'], //SFFC chapter
                'organization_type_id' => $data['organization_type_id'], //how did you hear about us?
                'other_phone' => $data['other_phone'],
                'parent_declines_sffc_support' => $supportChoices['parent_declines_sffc_support'],
                'parent_agrees_to_sffc_support' => $supportChoices['parent_agrees_to_sffc_support'],
                'parent_wants_more_info' => $supportChoices['parent_wants_more_info'],
                'primary_language_spoken' => $data['primary_language_spoken'],
                'reason_for_assistance' => $data['reason_for_assistance'],
                'referral_contact' => $data['referral_contact'],
                //'referral_date' => $data['referral_date'],
                'referral_organization' => $data['referral_organization'],
                'referral_organization_email' => $data['referral_organization_email'],
                'referral_organization_phone' => $data['referral_organization_phone'],
                'requesting_family_friend' => $serviceChoices['requesting_family_friend'],
                'requesting_host_family' => $serviceChoices['requesting_host_family'],
                'requesting_resource_friend' => $data['requesting_resource_friend'],
                'resources_provided' => $data['resources_provided'],
                'state' => $data['state'],
                'updated_by' => $userId,
                'urgency' => $data['urgency'],
                'zip' => $data['zip'],
            ]);
        });
    }

    public function updateIntake(Intake $intake, array $data): Intake
    {

        $supportChoices = [
            'parent_declines_sffc_support' => null,
            'parent_agrees_to_sffc_support' => null,
            'parent_wants_more_info'        => null,
        ];

        match ($data['sffc_choice']) {
            'declines'  => $supportChoices['parent_declines_sffc_support'] = true,
            'agrees'    => $supportChoices['parent_agrees_to_sffc_support'] = true,
            'more_info' => $supportChoices['parent_wants_more_info']        = true,
        };

        $serviceChoices = [
            'requesting_host_family' => null,
            'requesting_family_friend' => null,
        ];
        match ($data['requested_service']) {
            'host'  => $serviceChoices['requesting_host_family'] = true,
            'family'    => $serviceChoices['requesting_family_friend'] = true,
        };

        return DB::transaction(function () use ($intake, $data, $userId, $supportChoices, $serviceChoices) {
            $intake->update([
                'first_name' => $data['first_name'],
                'last_name' => $data['last_name'],
                'address_line_1' => $data['address_line_1'],
                'address_line_2' => $data['address_line_2'],
                'can_text_reminder' => $data['can_text_reminder'],
                'can_email_reminder' => $data['can_email_reminder'],
                'child_protective_services_experience' => $data['child_protective_services_experience'],
                'city' => $data['city'],
                'completed_by_id' => $userId,
                'date_of_birth' => $data['date_of_birth'],
                'do_not_share_list' => $data['do_not_share_list'],
                'email' => $data['email'],
                'emotional_behavioral_medical_concerns' => $data['emotional_behavioral_medical_concerns'],
                'ethnicity' => $data['ethnicity'],
                'expected_support_duration' => $data['expected_support_duration'],
                'family_preference' => $data['family_preference'],
                'gender' => $data['gender'],
                'first_name' => $data['first_name'],
                'hasSFFCHistory' => $data['hasSFFCHistory'],
                'intake_status_id' => $data['intake_status_id'],
                'is_a_sffc_fit' => $data['is_a_sffc_fit'],
                'is_homeless' => $data['is_homeless'],
                'known_risks' => $data['known_risks'],
                'mobile_phone' => $data['mobile_phone'],
                'last_name' => $data['last_name'],
                'number_of_children' => $data['number_of_children'],
                'organization_id' => $data['organization_id'], //SFFC chapter
                'organization_type_id' => $data['organization_type_id'], //how did you hear about us?
                'other_phone' => $data['other_phone'],
                'parent_declines_sffc_support' => $supportChoices['parent_declines_sffc_support'],
                'parent_agrees_to_sffc_support' => $supportChoices['parent_agrees_to_sffc_support'],
                'parent_wants_more_info' => $supportChoices['parent_wants_more_info'],
                'primary_language_spoken' => $data['primary_language_spoken'],
                'reason_for_assistance' => $data['reason_for_assistance'],
                'referral_contact' => $data['referral_contact'],
                //'referral_date' => $data['referral_date'],
                'referral_organization' => $data['referral_organization'],
                'referral_organization_email' => $data['referral_organization_email'],
                'referral_organization_phone' => $data['referral_organization_phone'],
                'requesting_family_friend' => $serviceChoices['requesting_family_friend'],
                'requesting_host_family' => $serviceChoices['requesting_host_family'],
                'requesting_resource_friend' => $data['requesting_resource_friend'],
                'resources_provided' => $data['resources_provided'],
                'state' => $data['state'],
                'updated_by' => $userId,
                'urgency' => $data['urgency'],
                'zip' => $data['zip'],
            ]);

            return $intake;
        });
    }

    public function deleteIntake(Intake $intake): void
    {
        DB::transaction(function () use ($intake) {
            $intake->delete();
        });
    }
}
