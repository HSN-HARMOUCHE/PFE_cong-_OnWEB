
@extends('layouts.app')

@section('content')

@include('CDN_links')

<link href={{asset('css/login.css')}} rel="stylesheet">

<center>

    <x-input-error :messages="$errors->get('password')"  class="mt-2" />
    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />

<div class="form-container">
    <p class="title">Nouveau mot de passe !!</p> 
    <form method="POST" action="{{ route('password.store') }}">
        @csrf

        <!-- Password Reset Token -->
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <div class="input-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" value="{{old('email', $request->email)}}" required autofocus autocomplete="username" >
            
        </div>
        <br/>
        {{-- psw --}}
        <div class="input-group">
            <label for="password">Mot de pass</label>
            <input id="password"
                                type="password"
                                name="password"
                                required autocomplete="new-password" />
            
        </div>
        <br/>
        {{-- Confirm psw --}}
        <div class="input-group">
            <label for="password_confirmation">Confirm Mot de pass</label>
            <input id="password_confirmation"
                                type="password"
                                name="password_confirmation"
                                required autocomplete="new-password" />
        </div>
        
        <br>
        <input type="submit" value="{{ __('Réinitialiser le mot de passe') }}" class="sign" >

        

    </form>

</div>

</center>
@endsection