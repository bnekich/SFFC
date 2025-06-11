@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>{{ $person->first_name }} {{ $person->last_name }}</h1>
        <p><strong>ID:</strong> {{ $person->id }}</p>
        <p><strong>Middle Name:</strong> {{ $person->middle_name ?? 'N/A' }}</p>
        <p><strong>Date of Birth:</strong> {{ $person->date_of_birth }}</p>
        <p><strong>Gender:</strong> {{ $person->gender == 'M' ? 'Male' : ($person->gender == 'F' ? 'Female' : 'Other') }}
        </p>
        <p><strong>Ethinicity:</strong> {{ $person->ethnicity ?? 'N/A' }}</p>
        <p><strong>Address:</strong> {{ $person->address->address_line_1 ?? 'N/A' }}</p>
        <p><strong>City:</strong> {{ $person->address->city ?? 'N/A' }}</p>
        <p><strong>State:</strong> {{ $person->address->state ?? 'N/A' }}</p>
        <p><strong>Zip Code:</strong> {{ $person->address->zip ?? 'N/A' }}</p>
        <p><strong>Country:</strong> {{ $person->address->country ?? 'N/A' }}</p>
        <p><strong>Email:</strong> {{ $person->email ?? 'N/A' }}</p>
        <p><strong>Phone:</strong> {{ $person->phone ?? 'N/A' }}</p>
        <p><strong>Text Reminders:</strong> {{ $person->can_text_reminder ? 'Yes' : 'No' }}</p>
        <p><strong>Email Reminders:</strong> {{ $person->can_email_reminder ? 'Yes' : 'No' }}</p>
        <a href="{{ route('person.edit', $person) }}" class="btn btn-warning">Edit</a>
        <a href="{{ route('person.index') }}" class="btn btn-secondary">Back</a>
    </div>
@endsection
