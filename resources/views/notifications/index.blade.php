@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center bg-white shadow-sm p-3 rounded mb-4">
        <h2>Notification</h2>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="row">
        @forelse($notifications as $notification)
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{ $notification->title }}</h5>
                        <p class="card-text">{{ $notification->description }}</p>
                        <p class="card-text"><strong>Due Date:</strong> {{ $notification->due_date }}</p>
                        <p class="card-text"><strong>Priority:</strong> {{ $notification->priority }}</p>
                        {{-- status enum('to_do', 'in_progress', 'completed') --}}
                        <p class="card-text"><strong>Status:</strong>
                            @if ($notification->status == 'to_do')
                                To Do
                            @elseif ($notification->status == 'in_progress')
                                In Progress
                            @else
                                Completed
                            @endif
                        </p>
                    </div>
                </div>
            </div>
        @empty
            <p>No reminders found.</p>
        @endforelse
    </div>
</div>
@endsection
