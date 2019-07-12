<div class="c-auth">
        <h1 class="c-auth__title">
            ログイン
        </h1>
        <form action="{{ route('login')}}" method="POST" class="c-auth__form">
          @csrf
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
                <input class="c-auth__check" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                <label class="c-auth__checkLabel" for="remember">
                    {{ __('Remember Me') }}
                </label>
           </div>
            <div class="c-auth__inputGroup">
              @if (Route::has('password.request'))
                  <a class="c-auth__passLink" href="{{ route('password.request') }}">
                      パスワードを忘れた方はコチラ
                  </a>
              @endif
              <button class="c-auth__submit btn-yellow" type="submit">ログイン</button>
            </div>

        </form>


    </div>
