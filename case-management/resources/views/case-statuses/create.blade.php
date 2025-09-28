@extends('layouts.app')

@section('title')
    - Add Case Status
@endsection

@section('content')

@section('header')
    <h3>Add Case Status</h3>
@endsection

<div class="container">
    <form class="row g-3 align-items-center" action="{{ route('case-statuses.store') }}" method="POST">
        @csrf
        <div class="col-auto">
            <label for="name" class="form-label label-required">Name</label>
            <input type="text" class="form-control-sm @error('name') is-invalid @enderror" id="name" name="name"
                value="{{ old('name') }}" placeholder="A Unique Name" required>
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="row
                g-3">
            <div class="col-auto">


                <button type="submit" class="btn btn-primary">Create</button>
                <a href="{{ route('case-statuses.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </div>
    </form>
</div>
@endsection
