
{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{$data['title']}}</title>
</head>
<body>
    <h1>Dear{{$Student['name'],}} </h1>
<p>Thank you for Joining School Of Scholars</p>
<p>To help us confirm it’s you, please verify your email address.</p>
{{ $data['body'] }}
<a href="{{$data['url']}}" class="btn btn-dark">Click Here to Verify Email</a>
<p>Your Password is {{$Student['gr']}}</p>
<p>Thank You,Team School Of Scholars</p>

</body>
</html> --}}

@component('mail::message')
<h1>Dear {{$User['name'],}} </h1>
<h2>Admito Has Reached Out for you</h2>
<p>To help us confirm it’s you, please verify your email address.</p>

@component('mail::panel')
{{ $data['body'] }}

<a href="{{$data['url']}}" class="button button-primary">Click Here to Verify Email</a>
<p>Your Password is {{$User['api_token']}}</p>
@endcomponent

<p>Thank You,Adminto</p>
@endcomponent