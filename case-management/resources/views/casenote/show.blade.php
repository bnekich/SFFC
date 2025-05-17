@extends('layouts.app')
@section('content')
    <div class="container">
        <h1>{{ $casenote->subject }}</h1>
        <p><strong>Note:</strong> {{ $casenote->note }}</p>
        <p><strong>Privacy Level:</strong> {{ $casenote->privacy_level }}</p>
        <p><strong>Status:</strong> {{ $casenote->status }}</p>
        @if ($casenote->tags->isNotEmpty())
            <p><strong>Tags:</strong> {{ $casenote->tags }}</p>
        @else
            <p><strong>Tags:</strong> None</p>
        @endif
        <p><strong>Is Approved:</strong> {{ $casenote->is_approved }}</p>
        <a href="{{ route('casenote.edit', $casenote) }}" class="btn btn-warning">Edit</a>
        <a href="{{ route('casenote.index', ['case_id' => $casenote->case_id]) }}" class="btn btn-secondary">Back</a>
    </div>
@endsection
