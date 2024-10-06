<!-- Logo o título -->
<div class="login-logo m-0 p-0 mb-3">
    @if (file_exists(public_path('images/logo.png')))
        <a href="{{ url('/') }}">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="img-fluid"><br>
        </a>
    @else
        <a href="{{ url('/') }}">
            {{ trans('panel.site_title') }}
        </a>
    @endif
    {{--     <hr style="border-top: 3px solid var(--button-color); width: 75%; margin: 10px auto;">
 --}}
</div>
