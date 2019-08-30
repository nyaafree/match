<div class="c-auth">
    <h1 class="c-auth__title">
        ユーザー登録
    </h1>
    <form action="{{ route('register')}}" method="POST" class="c-auth__form">
      @csrf
      <div class="c-auth__inputGroup">
        <label for="name" class="c-auth__inputTitle">ユーザー名（必須）</label>
        <input type="text" name="name" id="name" class="c-auth__inputField @error('name') is-invalid @enderror" value="{{ old('name') }}" required autocomplete="name" autofocus>
        @error('name')
            <span class="c-auth__error invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
      </div>
      <div class="c-auth__inputGroup">
        <label for="email" class="c-auth__inputTitle">メールアドレス（必須）</label>
        <input type="email" name="email" id="email" class="c-auth__inputField @error('email') is-invalid @enderror" value="{{ old('email') }}" required autocomplete="email">
        @error('email')
            <span class="c-auth__error invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
      </div>
      <div class="c-auth__inputGroup">
          <label for="password" class="c-auth__inputTitle">パスワード（必須）</label>
          <input type="password" name="password" id="password" class="c-auth__inputField @error('password') is-invalid @enderror" value="{{ old('password') }}" required autocomplete="new-password">
          @error('password')
              <span class="c-auth__error" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
          @enderror
       </div>
       <div class="c-auth__inputGroup">
            <label for="password-confirm" class="c-auth__inputTitle">パスワード再入力（必須）</label>
            <input type="password" name="password_confirmation" id="password-confirm" class="c-auth__inputField" required autocomplete="new-password">
        </div>
        <div class="c-auth__inputGroup btn-right">
          <button class="c-auth__submit btn-yellow" type="submit">送信</button>
        </div>
        @include('mypage.includes.formErrors')
    </form>


</div>
