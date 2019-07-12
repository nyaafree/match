<div class="c-auth">
        <h1 class="c-auth__title">
          パスワードリセット
        </h1>
        <div class="c-auth__status">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
        </div>
        <form action="{{ route('password.email') }}" method="POST" class="c-auth__form">
          @csrf
          <div class="c-auth__inputGroup">
            <label for="email" class="c-auth__inputTitle">メールアドレス</label>
            <input type="email" name="email" id="email" class="c-auth__inputField @error('email') is-invalid @enderror" value="{{ old('email') }}" required autocomplete="email" autofocus>
            @error('email')
                <span class="c-auth__error" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
          </div>
          
           
            <div class="c-auth__inputGroup">
              
              <button class="c-auth__submit btn-yellow" type="submit">パスワードリセット</button>
            </div>

        </form>


</div>
