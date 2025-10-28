@php
    use App\Enums\Statuses\IntakeStatus as Status;
@endphp

@extends('layouts.app')
@section('content')

@section('header')
    Intake Detail
@endsection

<p><strong>SFFC Fit?</strong>: {{ $intake->is_a_sffc_fit ? 'Yes' : 'No' }}</p>
<p><strong>Name:</strong> {{ $intake->parent_name }}
    <strong>Parent Phone</strong>: {{ $intake->parent_phone }}
    <strong>Referral Date</strong>:
    {{ $intake->referral_date ? \Carbon\Carbon::parse($intake->referral_date)->isoFormat('LL') : 'N/A' }}
</p>
<p><strong>Referral Contact</strong>: {{ $intake->referral_contact }}</p>
<p><strong>Case Summary</strong>: {{ $intake->case_summary }}</p>
<p><strong>Has SFFC History?</strong>: {{ $intake->has_sffc_history ? 'Yes' : 'No' }}
    <strong>Do Not Share?</strong>: {{ $intake->do_not_share ? 'Yes' : 'No' }}
    <strong>Requesting Hosting?</strong>: {{ $intake->requesting_host_family ? 'Yes' : 'No' }}
    <strong>Requesting Family Friend?</strong>: {{ $intake->requesting_family_friend ? 'Yes' : 'No' }}
    <strong>Requesting Resource Friend?</strong>: {{ $intake->requesting_resources_friend ? 'Yes' : 'No' }}
</p>
<p><strong>Urgency</strong>: {{ $intake->urgency }}</p>
<p><strong>Expected Support Duration</strong>: {{ $intake->expected_support_duration }}</p>
<p><strong>Family Preference</strong>: {{ $intake->family_preference }}</p>
<p><strong>Known Risks</strong>: {{ $intake->known_risks }}</p>
<p><strong>CPS Experience</strong>: {{ $intake->child_protective_services_experience }}</p>
<p><strong>Emotional, Behaviorial, Medical Concerns</strong>:
    {{ $intake->emotional_behavioral_medical_concerns }}
</p>
<p><strong>Resources Provided</strong>: {{ $intake->resources_provided }}</p>
<p><strong>Intake Status</strong>: {{ $intake->status->name }}
</p>
<p><strong>Intake Agent</strong>: {{ $intake->created_by }}</p>
<a href="{{ route('intake.index') }}" class="btn btn-secondary">Back to Intakes</a>
@endsection
