@if(!$errors->isEmpty())
    @if ( (!$errors->highPrice->isEmpty() || $errors->lowPrice->isEmpty()) && Request::is('/') )
        <div class="error-area">
            @foreach ($errors->all() as $error)
                <div class="error-message" role="alert">
                    {{ $error }}
                </div>
            @endforeach
        </div>
    @endif
@endif
