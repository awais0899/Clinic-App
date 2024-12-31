@component('mail::message')
# You have been invited to join as a therapist

You have been invited to join **{{ $invitation->clinic->name }}** as a therapist.

@component('mail::button', ['url' => route('invitation.accept', $invitation->token)])
    Accept Invitation
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
