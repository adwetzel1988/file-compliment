@extends('layouts.app')

@section('title', 'Search Results')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <h1 class="mb-4">Search Results</h1>

            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title">Results for: "{{ $query }}"</h5>
                    @if($complaints->count() > 0)
                        <p class="card-text">Found {{ $complaints->count() }} result(s).</p>
                    @else
                        <p class="card-text">No results found.</p>
                    @endif
                </div>
            </div>

            @foreach($complaints as $complaint)
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title">Compliment #{{ $complaint->complaint_number }}</h5>
                        <p class="card-text"><strong>Status:</strong> {{ ucfirst($complaint->status) }}</p>
                        <p class="card-text"><strong>Outcome:</strong> {{ ucfirst($complaint->outcome) }}</p>
                        <p class="card-text"><strong>Incident Date:</strong>
                            @if($complaint->incident_date instanceof \Carbon\Carbon)
                                {{ $complaint->incident_date->format('F d, Y') }}
                            @else
                                {{ $complaint->incident_date }}
                            @endif
                        </p>
                        @if($complaint->officer)
                            <h6 class="mt-3">Officer Information:</h6>
                            <p class="card-text"><strong>Name:</strong> {{ $complaint->officer->name }}</p>
                            <p class="card-text"><strong>Rank:</strong> {{ $complaint->officer->rank }}</p>
                            <p class="card-text"><strong>Division:</strong> {{ $complaint->officer->division }}</p>
                            <p class="card-text"><strong>Badge Number:</strong> {{ $complaint->officer->badge_number }}</p>
                        @endif
                        @auth
                            @if(in_array(auth()->user()->role, ['admin', 'subadmin']))
                                <a href="{{ route('admin.complaints.show', $complaint) }}" class="btn btn-primary mt-3">View Details</a>
                            @endif
                        @endauth
                    </div>
                </div>
            @endforeach

            <div class="text-center mt-4 mb-5">
                <a href="{{ url('/') }}" class="btn btn-secondary">Back to Home</a>
            </div>
        </div>
    </div>
</div>
@endsection
