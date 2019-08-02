@if(!$errors->isEmpty())
    <div class="error-area">
        <div class="error-show">
            <strong>エラー発生！フォームの入力内容に誤りがあります。</strong>
        </div>
        @foreach ($errors->all() as $error)
            <div class="error-message" role="alert">
                {{ $error }}
            </div>
        @endforeach
    </div>
@endif
