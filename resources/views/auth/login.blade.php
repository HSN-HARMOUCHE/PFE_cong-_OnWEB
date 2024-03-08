@extends('layouts.app')

@section('content')

@include('CDN_links')
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href={{asset('css/login.css')}} rel="stylesheet">
    <title>Connexion</title>
</head>
<body>

<center>

    <div class="form-container">
        <p class="title">Connexion  </p> 
        <form class="form" method="POST" action="{{route('login')}}">
            @csrf
            <div class="input-group">
                <label for="mat">Matricule ou CINE de utilisateur </label>
                <input type="text" name="mat" id="user_mat" required  >
                
            </div>
            <br/>
            <div class="input-group">
                <label for="psw_cnx">Mot de pass</label>
                <input id="password"
                                    type="password"
                                    name="psw_cnx"
                                    required autocomplete="current-psw_cnx" />
            </div>
                    
            <br>
            <input type="submit" value="{{ __('Connexion') }}" class="sign" >
        </form>
        <br>
        @if (Route::has('password.request'))
        <a id="fpsw" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('password.request') }}">
            {{ __('Mot de passe oublié ?') }}
        </a>
        @endif
 
    </div>

</center>

    {{-- alerts --}}
    <x-auth-session-status :status="session('status')" />
    <x-input-error :messages="$errors->get('mat')" class="mt-2" />
    <x-input-error :messages="$errors->get('psw_cnx')" class="mt-2" />
        
    {{-- end alerts --}}

</body>

@endsection
