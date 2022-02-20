@component('mail::message')
# {{ $announcement->title }}

Good day Students!
<br />

{{-- {{ $announcement->description }} --}}

{!! nl2br("$announcement->description") !!}

@component('mail::button', ['url' => $url])
View {{ $announcement->title }}
@endcomponent

Thanks,<br>
{{ config('app.name') }} <br/>
Ms. Katrina
@endcomponent
