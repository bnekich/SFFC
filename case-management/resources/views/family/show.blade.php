@extends('layouts.app')
@section('content')
    <div class="container">
        <h1>{{ $family->family_name }}</h1>
        <p><strong>Address:</strong> {{ $family->address->address_line_1 ?? 'N/A' }}</p>
        <p><strong>City:</strong> {{ $family->address->city ?? 'N/A' }}</p>
        <p><strong>State:</strong> {{ $family->address->state ?? 'N/A' }}</p>
        <p><strong>Zip Code:</strong> {{ $family->address->zip ?? 'N/A' }}</p>
        <p><strong>Associated People:</strong></p>
        <ul>
            @foreach ($family->persons as $person)
                <li>
                    <a href="{{ route('person.show', $person->id) }}">
                        {{ $person->last_name . ', ' . $person->first_name }}</a>
                </li>
            @endforeach
        </ul>
        <p><strong>Created By:</strong>
            @if ($family->createdByUser)
                {{ $family->createdByUser->firstName }} {{ $family->createdByUser->lastName }}
            @else
                N/A
            @endif
        </p>
        <p><strong>Updated By:</strong>
            @if ($family->updatedByUser)
                {{ $family->updatedByUser->firstName }} {{ $family->updatedByUser->lastName }}
            @else
                N/A
            @endif
        </p>
        <a href="{{ route('family.edit', $family) }}" class="btn btn-warning">Edit</a>
        <a href="{{ route('family.index') }}" class="btn btn-secondary">Back</a>

    </div>
@endsection
