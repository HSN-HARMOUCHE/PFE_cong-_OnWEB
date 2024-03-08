@extends('layouts.app')

@section('content')

@include('CDN_links')

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href={{asset('css/login.css')}} rel="stylesheet">
    <title>forget psw</title>
{{-- 
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script> --}}
</head>
<body>

<center>
    <x-auth-session-status  class="alert alert-success" :status="session('status')" />
    <x-input-error :messages="$errors->get('email')" class="mt-2" />

    <div class="form-container" style="width: 30%">
        <p class="title">Mot de passe oublié ?</p> 
        <form class="form" method="POST" action="{{ route('password.email') }}">
            @csrf
            <div class="input-group">
                <label for="email">Emai</label>
                <input type="email" name="email" id="email" :value="old('email')" required autofocus   >
            </div>
            <br/>
            <br>
            <input type="submit" value="{{ __('Envoyer le lien de réinitialisation') }}" class="sign" >
        </form>
        <br>
        <div><a href="/login">Login</div>
    </div>
</center>

</body>

@endsection
