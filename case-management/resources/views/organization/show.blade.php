@extends('layouts.app')
@section('content')
    <div class="container">
        <h1>{{ $organization->name }}</h1>
        <p><strong>Type:</strong> {{ $organization->organizationType->name ?? 'N/A' }}</p>
        <p><strong>Address:</strong> {{ $organization->address->address_line_1 ?? 'N/A' }}</p>
        <p><strong>City:</strong> {{ $organization->address->city ?? 'N/A' }}</p>
        <p><strong>State:</strong> {{ $organization->address->state ?? 'N/A' }}</p>
        <p><strong>Zip Code:</strong> {{ $organization->address->zip ?? 'N/A' }}</p>
        <p><strong>Contact Person:</strong> {{ $organization->contact_person_name ?? 'N/A' }}</p>
        <p><strong>Contact Person Title:</strong> {{ $organization->contact_person_title ?? 'N/A' }}</p>
        <p><strong>Contact Person Email:</strong> {{ $organization->contact_person_email ?? 'N/A' }}</p>
        <p><strong>Contact Person Phone:</strong> {{ $organization->contact_person_phone ?? 'N/A' }}</p>
        <p><strong>Contact Person Mobile:</strong> {{ $organization->contact_person_mobile ?? 'N/A' }}</p>
        <p><strong>Associated People:</strong>
            @foreach ($organization->persons as $person)
                {{ $person->last_name . ', ' . $person->first_name }}<br>
            @endforeach
        </p>
        <p><strong>Notes:</strong> {{ $organization->notes ?? 'N/A' }}</p>
        <a href="{{ route('organization.edit', $organization) }}" class="btn btn-warning">Edit</a>
        <a href="{{ route('organization.index') }}" class="btn btn-secondary">Back</a>
    </div>
@endsection
