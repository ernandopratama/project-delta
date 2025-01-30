@props([
    'session' => 'success', // session name
    'type' => 'success', // info, success, warning, error
])

@if(session($session))
    <div class="alert alert-{{ $type }} alert-dismissible fade show" role="alert" 
        x-data="{ show: true }"
        x-show="show"
        x-transition
        x-init="setTimeout(() => show = false, 2000)">
        {{ session($session) }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

