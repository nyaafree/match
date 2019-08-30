@if(!$errors->isEmpty())
    <div class="error-area">
        @foreach ($errors->all() as $error)
            <div class="error-message" role="alert">
                {{ $error }}
            </div>
        @endforeach
    </div>
@endif
