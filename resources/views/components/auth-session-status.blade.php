@props(['status'])


@if ($status)

<div id="element" aria-live="polite" aria-atomic="true" class="d-flex justify-content-center align-items-center" style="min-height: 200px; float:inline-end ;z-index:999">
    <!-- Then put toasts within -->
    <div class="toast" role="alert" aria-live="assertive" aria-atomic="true" style="position: absolute; top: 100px; right: 10px;" data-delay="5000" >
    <div class="toast-header" style="background-color:#706d6d">
        <b style="color:#ffffff; letter-spacing: 2px " class="mr-auto">Notification !! </b>
        <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="toast-body" style="background-color: #b3b3b3">
        <strong>{{$status}}</strong>
    </div>
    </div>
</div>

<script>
    $('.toast').toast('show')
</script>

@endif

