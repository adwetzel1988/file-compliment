@extends('layouts.app')

@section('content')
    <h1>{{ auth()->user()->role === 'admin' ? 'All Compliments' : (auth()->user()->role === 'subadmin' ? 'My Assigned Compliments' : 'Default Title') }}</h1>

    <!-- Custom CSS for spacing and search alignment -->
    <style>
        h1 {
            margin-bottom: 20px; /* Increase margin below the heading */
        }
        .table {
            margin-top: 20px; /* Increase margin above the table */
        }
        .table th, .table td {
            padding: 15px; /* Increase padding in table cells */
        }
        .btn {
            margin-right: 10px; /* Add margin between buttons */
        }
        /* Align search input to the left */
        .dataTables_filter {
            float: left !important; /* Float the search box to the left */
            margin-bottom: 20px;
            text-align: left !important /* Add some space below the search box */
        }
        .dataTables_filter input {
            margin-left: 0; /* Remove default margin on the left */
        }
        .status-filter {
            float: right; /* Float the status filter to the right */
            margin-bottom: 20px;
        }
    </style>

    <!-- Include DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">

    <div class="status-filter">
        <label for="status">Filter by Status:</label>
        <select id="status" name="status" class="form-control">
            <option value="">All</option>
            <option value="pending" {{ request('status') == 'read' ? 'selected' : '' }}>Read</option>
            <option value="in_progress" {{ request('status') == 'unread' ? 'selected' : '' }}>Unread</option>
        </select>
    </div>

    <table class="table" id="complaintsTable">
        <thead>
            <tr>
                <th>Compliment #</th>
                <th>Created by</th>
                <th>Officer</th>
                <th>Status</th>
                <th>Outcome</th>
                <th>Created at</th>
                <th>Read Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($complaints as $complaint)
                <tr>
                    <td>{{ $complaint->complaint_number }}</td>
                    <td>{{ $complaint->user->name ?? 'Anonymous' }}</td>
                    <td>{{ $complaint->officer->name ?? 'Not Provided' }}</td>
                    <td>{{ \Illuminate\Support\Str::headline($complaint->status) }}</td>
                    <td>
                        @if($complaint->status === 'completed')
                            {{ ucfirst($complaint->outcome) }}
                        @else
                            N/A
                        @endif
                    </td>
                    <td>{{ $complaint->created_at }}</td>
                    <td>
                        @if($complaint->status === 'read')
                            {{ $complaint->updated_at }}
                        @else
                            N/A
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('admin.complaints.show', $complaint) }}" class="btn btn-sm btn-primary">View</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Include jQuery and DataTables JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

    <script>
        $(document).ready(function() {
            var table = $('#complaintsTable').DataTable({
                paging: false, // Disable pagination
                ordering: true, // Disable sorting
                searching: true, // Enable searching
                order: [[5, 'desc']] // Sort by incident date in descending order
            });

            // Apply initial filter if status is present in the query parameters
            var initialStatus = '{{ request('status') }}';
            if (initialStatus) {
                $('#status').val(initialStatus).trigger('change');
            }

            $('#status').change(function() {
                const status = $(this).val();
                const url = new URL(window.location.href);
                if (status) {
                    url.searchParams.set('status', status);
                } else {
                    url.searchParams.delete('status');
                }
                window.history.pushState({}, '', url);
                window.open(url, '_self');
            });
        });
    </script>
@endsection
