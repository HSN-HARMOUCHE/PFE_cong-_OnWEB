<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"> 
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Congé Application</title>

    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css">

</head>

<body>
    <header>
        <div class="inner-width">
          <h1 class="logo"><span style="color:#7257fa">Conge</span>ON_WEB</h1>
          <span class="menu-toggle-btn"><i class=" fas fa-bars"></i> </span>
          
        @if(Auth::user())
        <nav class="navigation-menu">

        
            <a href="{{ route('dashboard') }}"><i class="fas fa-home home"></i> Home</a>
            
            @can('Admin-user')
            <a href="/emplyee"></i> Employées</a>
            @endcan

            <a href="/conge"></i> Congés</a>
            <a href="{{ route('absences') }}"></i> Absences</a>
            <a href="/g"></i> Statistique</a>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button class="aj_btn" type="submit">
                    Déco <i class="fas fa-sign-out-alt" aria-hidden="true"></i> 
                </button>
            </form>
        </nav>
        @endif
        </div>
      </header>


    <!-- Main content section -->
    <main class="flex-grow-1" style="margin-bottom: 20px">
        @yield('content')
    </main>

<script>

document.querySelector(".menu-toggle-btn").addEventListener("click", function() {
  this.classList.toggle("fa-times");
  document.querySelector(".navigation-menu").classList.toggle("active");
});


</script>

</body>

</html>
