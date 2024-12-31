@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">
    <h1 class="text-2xl font-bold mb-4">Invitations for {{ $clinic->name }}</h1>
    <table class="table-auto w-full border-collapse border border-gray-200">
        <thead>
            <tr class="bg-gray-100">
                <th class="border px-4 py-2">Email</th>
                <th class="border px-4 py-2">Token</th>
                <th class="border px-4 py-2">Status</th>
                <th class="border px-4 py-2">Expires At</th>
            </tr>
        </thead>
        <tbody>
            @forelse($invitations as $invitation)
                <tr>
                    <td class="border px-4 py-2">{{ $invitation->email }}</td>
                    <td class="border px-4 py-2">{{ $invitation->token }}</td>
                    <td class="border px-4 py-2">{{ ucfirst($invitation->status) }}</td>
                    <td class="border px-4 py-2">{{ $invitation->expires_at->format('Y-m-d H:i') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center border px-4 py-2">No invitations sent yet.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="mt-4">
        {{ $invitations->links() }}
    </div>
</div>
@endsection
