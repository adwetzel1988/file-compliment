@extends('layouts.app')

@section('title', 'Thank You for Your Complaint')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Thank You for Submitting Your Complaint</div>

                <div class="card-body">
                    <h4 class="mb-4">Your complaint has been successfully filed.</h4>
                    
                    <p class="mb-3">Your complaint number is: <strong>{{ $complaint->complaint_number }}</strong></p>
                    <p class="mb-3">Please keep this number for your records.</p>

                    @if(Auth::check())
                        <p class="mb-4">You can track the status of your complaint by logging into your account and visiting the "My Complaints" section.</p>
                        <a href="{{ route('complaints.index') }}" class="btn btn-primary">View My Complaints</a>
                    @else
                        <p class="mb-4">As you chose to remain anonymous, you won't be able to track the status of your complaint online. If you need to provide additional information or check on the status, please contact our office and reference your complaint number.</p>
                    @endif

                    <div class="mt-4">
                        <a href="/" class="btn btn-secondary">Return to Home</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection