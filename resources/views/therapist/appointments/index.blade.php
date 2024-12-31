@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

<!-- Display appointments -->
<table class="table table-striped">
    <thead>
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
                <td>{{ ucfirst($appointment->status) }}</td>
                <td>
                    @if($appointment->status === 'pending')
                        <form action="{{ route('therapist.appointments.complete', $appointment) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-success btn-sm">Complete</button>
                        </form>
                    @endif
                    <a href="{{ route('therapist.appointments.show', $appointment) }}" class="btn btn-info btn-sm">View Details</a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<!-- Pagination links -->
{{ $appointments->links() }}
