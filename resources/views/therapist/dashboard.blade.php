@extends('layouts.app')

@section('title', 'Therapist Dashboard')

@section('content')
<div class="container mt-5">
    <h1 class="text-center mb-5 text-primary font-weight-bold">Therapist Dashboard</h1>

    <!-- Success and Error Alerts -->
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <!-- Appointments Card -->
    <div class="card shadow-lg border-0 rounded-3">
        <div class="card-header bg-gradient-primary text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0 text-black">Your Appointments</h5>
            <span class="badge bg-light text-dark rounded-pill">{{ $appointments->count() }} Appointments</span>
        </div>
        <div class="card-body p-4">
            @if($appointments->isEmpty())
                <p class="text-center text-muted">You have no appointments assigned at the moment. Please check back later.</p>
            @else
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped table-dark rounded-3">
                        <thead class="thead-light">
                            <tr>
                                <th>Client Name</th>
                                <th>Service</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($appointments as $appointment)
                                <tr>
                                    <td>{{ $appointment->client->name }}</td>
                                    <td>{{ $appointment->menu->name }}</td>
                                    <td>
                                        <span class="badge 
                                            @if($appointment->status == 'pending') badge-warning
                                            @elseif($appointment->status == 'completed') badge-success
                                            @else badge-secondary @endif">
                                            {{ ucfirst($appointment->status) }}
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        @if($appointment->status === 'pending')
                                            <form action="{{ route('therapist.appointments.complete', $appointment) }}" method="POST" style="display:inline;">
                                                @csrf
                                                <button type="submit" class="btn btn-success btn-sm shadow-sm" onclick="return confirm('Are you sure you want to mark this appointment as complete?');">
                                                    <i class="fas fa-check-circle"></i> Complete
                                                </button>
                                            </form>
                                        @endif
                                        <a href="{{ route('therapist.appointments.show', $appointment) }}" class="btn btn-info btn-sm shadow-sm">
                                            <i class="fas fa-eye"></i> View Details
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- Pagination Links -->
                <div class="d-flex justify-content-center mt-3">
                    {{ $appointments->links('pagination::bootstrap-4') }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

@section('styles')
<!-- Include custom styles or a CDN for icons -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
<style>
    .table th, .table td {
        text-align: center;
    }

    .btn-sm {
        padding: 5px 15px;
    }

    .badge {
        font-size: 1.1rem;
    }

    .table-responsive {
        margin-top: 20px;
    }

    .card-header {
        background: linear-gradient(45deg, #ff6f61, #ffb73a);
        border-radius: 8px;
    }

    .table-hover tbody tr:hover {
        background-color: rgba(0, 0, 0, 0.05);
    }

    .shadow-lg {
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
    }

    .pagination {
        justify-content: center;
    }

    .pagination .page-item .page-link {
        color: #555;
        padding: 10px 20px;
        margin: 0 2px;
        background-color: #f8f9fa;
        border: 1px solid #ddd;
        border-radius: 50%;
    }

    .pagination .page-item.active .page-link {
        background-color: #007bff;
        color: white;
        border-color: #007bff;
    }

    .pagination .page-item:hover .page-link {
        background-color: #007bff;
        color: white;
    }

    /* Alert Styling */
    .alert-dismissible .close {
        padding: 0.75rem;
        color: inherit;
    }
</style>
@endsection
