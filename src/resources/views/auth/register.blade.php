@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endsection

@section('content')


<div class="register-wrapper">

  

    {{-- タイトル --}}
    <h2 class="page-title">Register</h2>

    {{-- カード --}}
    <div class="form-card">
        <form method="POST" action="{{ route('register') }}">
            @csrf

            {{-- お名前 --}}
            <div class="form-group">
                <label>お名前</label>
                <input type="text" name="name" value="{{ old('name') }}">
                @error('name')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>

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

            <button class="btn-submit">登録</button>
        </form>
    </div>
</div>

@endsection
