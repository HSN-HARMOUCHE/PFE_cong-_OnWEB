<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1);transform: ;msFilter:;">
    <path d="M19 4h-2V2h-2v2H9V2H7v2H5c-1.103 0-2 .897-2 2v14c0 1.103.897 2 2 2h14c1.103 0 2-.897 2-2V6c0-1.103-.897-2-2-2zm.002 16H5V8h14l.002 12z"></path>
    <path d="M11 10h2v5h-2zm0 6h2v2h-2z"></path>
</svg>
<h1>Bonjour !</h1>
<hr />
<p>Votre congé a été <h2 style="color: {{ $statue === 'accepte' ? 'green' : ($statue === 'refuse' ? 'red' : 'yellow') }}">{{ $statue }}</h2> 
    du <strong>{{ $startDate }}</strong> au <strong>{{ $endDate }}</strong></p>
<p>par <strong><span style="text-decoration-line: underline;">{{ $managerName }}</span></strong></p>
<p>Pour confirmer, veuillez contacter votre responsable <strong>" {{ $managerName }} "</strong> à l'adresse e-mail suivante : <strong>{{ $managerEmail }}</strong></p>
<p>Merci d’utiliser notre application!</p>