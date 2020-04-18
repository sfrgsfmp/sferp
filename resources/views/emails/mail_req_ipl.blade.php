@component('mail::message')

Dear, Sir/Madam, <br>
IPL Number {{$ipl['noipl']}}, requesting for your approval. <br>

<table style="border=0">
    <tr>
        <td> Noipl </td> <td> : </td> <td> {{ $ipl['noipl'] }}</td>
    </tr>
    <tr>
        <td> Species </td> <td> : </td> <td>{{ implode(',', $ipl->species()->get()->pluck('name')->toArray()) }}</td>
    </tr>
    <tr>
        <td> Sortimen </td> <td> : </td> <td>{{ $ipl['sortimen'] }}</td>
    </tr>
    <tr>
        <td> Vendor </td> <td> : </td> <td> {{ implode(',', $ipl->vendor()->get()->pluck('name_vendor')->toArray()) }}</td>
    </tr>
    <tr>
        <td> Volume </td> <td> : </td> <td> {{ $ipl['volume'] }}</td>
    </tr>

</table>

<br>
To follow up, please click the link below. <br>

<?php $url = 'http://127.0.0.1:8000/ipl/show'; ?>

@component('mail::button', ['url' => $url])
View Request
@endcomponent

Thanks, <br>
{{config('app.name')}}
@endcomponent