@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Invitation Accepted</h1>
    <p>You have been invited to join as a {{ $invitation->role }} at {{ $invitation->clinic->name }}.</p>

    <form action="{{ route('register') }}" method="GET">
        <input type="hidden" name="invitation_token" value="{{ $invitation->token }}" />
        <input type="hidden" name="role" value="{{ $invitation->role }}" />
        <button type="submit" class="btn btn-primary">Complete Registration</button>
    </form>
</div>
@endsection
