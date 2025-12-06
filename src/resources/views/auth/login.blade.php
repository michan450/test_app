@extends('layouts.app')

@section('content')

<div class="register-wrapper">

    {{-- ロゴ --}}
    <h1 class="site-logo">FashionablyLate</h1>

    {{-- タイトル --}}
    <h2 class="page-title">Login</h2>

    {{-- カード --}}
    <div class="form-card">
        <form method="POST" action="{{ route('login') }}">
            @csrf

            {{-- メールアドレス --}}
            <div class="form-group">
                <label>メールアドレス</label>
                <input type="email" name="email" value="{{ old('email') }}">
                @error('email')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>

            {{-- パスワード --}}
            <div class="form-group">
                <label>パスワード</label>
                <input type="password" name="password">
                @error('password')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>

            {{-- ログインボタン --}}
            <button type="submit" class="btn-submit">ログイン</button>
        </form>

        {{-- 会員登録リンク --}}
        <p class="text-center mt-3">
            <a href="{{ route('register') }}">会員登録はこちら</a>
        </p>
    </div>
</div>

@endsection
