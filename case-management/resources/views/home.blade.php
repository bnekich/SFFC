@extends('layouts.app')
@section('title', 'Home')

@section('content')
    <section>
        <h1 class="custom-color">Welcome to My App</h1>
        <p>Please <a href="{{ route('login') }}" class="custom-color btn btn-primary">log in</a> to continue.</p>
                <!-- Bootstrap Modal Trigger -->
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Launch Modal
                </button>
                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Test Modal</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Bootstrap JS is working!
                            </div>
                        </div>
                    </div>
                </div>
    </section>
@endsection
