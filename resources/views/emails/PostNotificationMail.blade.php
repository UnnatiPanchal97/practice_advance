@component('mail::message')
Hello {{ $user }}

A new post created right now checkout.

@component('mail::button', ['url' => 'http://127.0.0.1:8000/home/posts'])
Check Post
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
