@component('mail::message')

Haiiii <br>
Testing sending email to {{$data['emailto']}}
<br>
Message : {{$data['message']}}


<!-- component('mail::button', ['url' => ''])
Button text
endcomponent -->

Thanks, <br>
{{config('app.name')}}
@endcomponent