@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Create Intake</h1>
        <form action="{{ route('intake.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="parent_name">Parent's Name</label>
                <input type="text" name="parent_name" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="parent_phone">Parent's Phone Number</label>
                <input type="text" name="parent_phone" class="phone-input form-control" required>
            </div>
            <div class="form-group">
                <label for="referral_date">Referral Date</label>
                <input type="date" name="referral_date" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="referral_contact">Referral Contact (email/phone)</label>
                <textarea name="referral_contact" class="form-control"></textarea>
            </div>
            <!-- Add other fields as needed -->
            <button type="submit" class="btn btn-primary">Create</button>
        </form>
    </div>
@endsection
