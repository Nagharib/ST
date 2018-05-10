Hi {{ $name }},
<p>Your registration is completed. Please click the link</p>

{{ route('confirmation' , $token) }}