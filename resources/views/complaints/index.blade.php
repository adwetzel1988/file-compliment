@extends('layouts.app')

@section('title', 'My Complaints')

@section('content')
    <h1>My Complaints</h1>
    <table class="table">
        <thead>
            <tr>
                <th>Complaint Number</th>
                <th>Status</th>
                <th>Incident Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($complaints as $complaint)
                <tr>
                    <td>{{ $complaint->complaint_number }}</td>
                    <td>{{ ucfirst($complaint->status) }}</td>
                    <td>{{ $complaint->incident_date }}</td>
                    <td>
                        <a href="{{ route('complaints.show', $complaint) }}" class="btn btn-sm btn-primary">View</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection