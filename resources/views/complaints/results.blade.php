@extends('layouts.app')

@section('title', 'Search Results')

@section('content')
<div class="container">
    <h1>Search Results</h1>
    @if(isset($query))
        <p>You searched for: {{ $query }}</p>
    @endif
    <p>Number of read compliments: {{ $results->count() }}</p>
    @if($results->count() > 0)
        <div class="row">
            @foreach($results as $complaint)
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <h5 class="card-title">Complaint #{{ $complaint->complaint_number }}</h5>
                            @if($complaint->officer)
                                <p class="card-text">Officer: {{ $complaint->officer->name }}</p>
                            @endif
                            <p class="card-text">Compliment: {{ $complaint->description }}</p>
                            <p class="card-text">Status: Read</p>
                            <p class="card-text">Action Taken: {{ $complaint->action_taken }}</p>
                            <p class="card-text">Created at: {{ $complaint->created_at->format('m/d/Y') }}</p>
                            <p class="card-text">Read at: {{ $complaint->updated_at->format('m/d/Y') }}</p>
                            @if(auth()->user() && (auth()->user()->role === 'admin' || auth()->user()->role === 'subadmin'))
                                <a href="{{ route('admin.complaints.show', $complaint->id) }}" class="btn btn-primary">View Details</a>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <p>No founded and completed complaints found.</p>
    @endif
    <a href="{{ route('complaints.search') }}" class="btn btn-primary">New Search</a>
</div>
@endsection
