@php($flash = !empty(Session::get('caffeinated')["flash"]) ? Session::get('caffeinated')["flash"] : FALSE )
@if($flash)
    <p class="flash-alert {{$flash['level']}}"
       onClick="this.parentNode.removeChild(this);">
        {{ $flash["message"] }}
    </p>
@endif
