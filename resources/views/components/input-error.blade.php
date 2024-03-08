@props(['messages'])

@if ($messages)
<div id="element" aria-live="polite" aria-atomic="true" class="d-flex justify-content-center align-items-center" style="min-height: 200px; float:inline-end ;">
    <!-- Then put toasts within -->
    <div class="toast" role="alert" aria-live="assertive" aria-atomic="true" style="position: absolute; top: 100px; right: 10px;" data-delay="10000" >
    <div class="toast-header" style="background-color:#ef2e41">
        <strong class="mr-auto" style="	font-weight:bold; color: #083865 ;">Error !! </strong>
        <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="toast-body" style="background-color: #e6e6e6">
        <ul>
            @foreach ((array) $messages as $message)
                <li> {{ $message }}</li>
            @endforeach
        </ul>
    </div>
    </div>
</div>

<script>
    $('.toast').toast('show')
</script>
@endif


