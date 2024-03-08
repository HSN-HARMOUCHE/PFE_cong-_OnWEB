
 <center>
   
    <link href={{asset('css/login.css')}} rel="stylesheet">
        <div class="form-container">
           {{ __('pour cette action, nous devons confirmer votre mot de passe. Veuillez confirmer votre mot de passe avant de continuer.') }}   
            <hr>
            <form  method="POST" action="{{ route('password.confirm') }}">
                @csrf
                <div class="input-group">
                    <label for="psw_cnx">Mot de pass</label>
                    <input id="password" class="block mt-1 w-full"
                                            type="password"
                                            name="psw_cnx"
                                            required autocomplete="current-password" />
                    <x-input-error style="color: red" :messages="$errors->get('psw_cnx')" class="mt-2" />
                </div>
                        
                <br>
                <input type="submit" value="{{ __('Connexion') }}" class="sign" >
            </form>
        </div>
    
    </center>