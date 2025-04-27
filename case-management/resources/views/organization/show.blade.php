@extends('layouts.app')
@section('content')
    <div class="container">
        <h1>{{ $organization->name }}</h1>
        <p><strong>ID:</strong> {{ $organization->id }}</p>
        <p><strong>Type:</strong> {{ $organization->type }}</p>
        <p><strong>Address:</strong> {{ $organization->address->address_line_1 ?? 'N/A' }}</p>
        <p><strong>City:</strong> {{ $organization->address->city ?? 'N/A' }}</p>
        <p><strong>State:</strong> {{ $organization->address->state ?? 'N/A' }}</p>
        <p><strong>Zip Code:</strong> {{ $organization->address->zip_code ?? 'N/A' }}</p>
        <p><strong>Country:</strong> {{ $organization->address->country ?? 'N/A' }}</p>
        <p><strong>Email:</strong> {{ $organization->email ?? 'N/A' }}</p>
        <p><strong>Phone:</strong> {{ $organization->phone ?? 'N/A' }}</p>
        <a href="{{ route('organization.edit', $organization) }}" class="btn btn-warning">Edit</a>
        <a href="{{ route('organization.index') }}" class="btn btn-secondary">Back</a>
    </div>
@endsection
