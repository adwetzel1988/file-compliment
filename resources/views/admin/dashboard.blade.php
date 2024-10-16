@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
    <style>
        .card-link {
            text-decoration: none;
            color: inherit;
        }
    </style>

    <h1>Admin Dashboard</h1>
    <div class="row">
        <div class="col-md-4">
            <a href="{{ route('admin.complaints.index') }}" class="card-link">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Total Compliments</h5>
                        <p class="card-text">{{ $stats['total'] }}</p>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-4">
            <a href="{{ route('admin.complaints.index', ['status' => 'read']) }}" class="card-link">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Read Compliments</h5>
                        <p class="card-text">{{ $stats['read'] }}</p>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-4">
            <a href="{{ route('admin.complaints.index', ['status' => 'unread']) }}" class="card-link">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Unread Compliments</h5>
                        <p class="card-text">{{ $stats['unread'] }}</p>
                    </div>
                </div>
            </a>
        </div>
    </div>
    <div class="mt-4">
        <a href="{{ route('admin.complaints.index') }}" class="btn btn-primary">View All Compliments</a>
    </div>

    <div class="mt-4">
        <h2>Latest Messages</h2>
        @foreach($latestMessages as $message)
            <a href="{{ route('admin.complaints.show', $message->complaint_id) }}" class="card-link">
                <div class="card mb-2">
                    <div class="card-body">
                        <h6 class="card-subtitle mb-2 text-muted">{{ $message->sender->name }} - {{ $message->created_at->format('M d, Y H:i') }}</h6>
                        <p class="card-text">{{ $message->content }}</p>
                    </div>
                </div>
            </a>
        @endforeach
    </div>

    <div class="mt-4">
        <h2>Latest Notes</h2>
        @foreach($latestNotes as $note)
            <a href="{{ route('admin.complaints.show', $note->complaint_id) }}" class="card-link">
                <div class="card mb-2">
                    <div class="card-body">
                        <h6 class="card-subtitle mb-2 text-muted">{{ $note->user->name }} - {{ $note->created_at->format('M d, Y H:i') }}</h6>
                        <p class="card-text">{{ $note->content }}</p>
                    </div>
                </div>
            </a>
        @endforeach
    </div>
@endsection
