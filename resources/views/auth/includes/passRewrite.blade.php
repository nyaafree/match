<div class="c-auth">
        <h1 class="c-auth__title">
            パスワード再設定
        </h1>
        <form action="{{ route('password.update')}}" method="POST" class="c-auth__form">
          @csrf

          <input type="hidden" name="token" value="{{ $token }}">
          <div class="c-auth__inputGroup">
            <label for="email" class="c-auth__inputTitle">メールアドレス（必須）</label>
            <input type="email" name="email" id="email" class="c-auth__inputField @error('email') is-invalid @enderror" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>
            @error('email')
                <span class="c-auth__error" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
          </div>
          <div class="c-auth__inputGroup">
              <label for="password" class="c-auth__inputTitle">パスワード（必須）</label>
              <input type="password" name="password" id="password" class="c-auth__inputField @error('password') is-invalid @enderror" required autocomplete="new-password">
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
              <button class="c-auth__submit btn-yellow" type="submit">パスワード再設定</button>
            </div>

        </form>


    </div>
