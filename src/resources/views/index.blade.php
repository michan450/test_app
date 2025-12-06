<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Contact Form</title>
  <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
  <link rel="stylesheet" href="{{ asset('css/index.css') }}" />
  <style>
    .error {
      color: red;
      font-size: 14px;
      margin-top: 4px;
    }
  </style>
</head>

<body>
  <header class="header">
    <div class="header__inner">
      <a class="header__logo" href="/">
        FashionablyLate
      </a>
    </div>
  </header>

  <main>
    <div class="contact-form__content">
      <div class="contact-form__heading">
        <h2>Contact</h2>
      </div>

      <form class="form" action="/contact/confirm" method="post">
        @csrf

        {{-- お名前 --}}
        <div class="form__group">
          <label class="form__label">お名前<span class="form__label--required"></span></label>

          <div class="form__input--name">
            <input type="text" name="last_name" placeholder="姓（例：山田）" value="{{ old('last_name') }}">
            <input type="text" name="first_name" placeholder="名（例：太郎）" value="{{ old('first_name') }}">
          </div>

          @error('last_name')
            <p class="error">{{ $message }}</p>
          @enderror
          @error('first_name')
            <p class="error">{{ $message }}</p>
          @enderror
        </div>

        {{-- 性別 --}}
        <div class="form__group">
          <label class="form__label">性別<span class="form__label--required"></span></label>

          <div class="form__radio-group">
            <label><input type="radio" name="gender" value="1" {{ old('gender')=='1' ? 'checked' : '' }}> 男性</label>
            <label><input type="radio" name="gender" value="2" {{ old('gender')=='2' ? 'checked' : '' }}> 女性</label>
            <label><input type="radio" name="gender" value="3" {{ old('gender')=='3' ? 'checked' : '' }}> その他</label>
          </div>

          @error('gender')
            <p class="error">{{ $message }}</p>
          @enderror
        </div>

        {{-- メールアドレス --}}
        <div class="form__group">
          <label class="form__label">メールアドレス<span class="form__label--required"></span></label>

          <div class="form__input-area">
            <input type="email" name="email" placeholder="例：test@example.com" value="{{ old('email') }}">
          </div>

          @error('email')
            <p class="error">{{ $message }}</p>
          @enderror
        </div>

        {{-- 電話番号 --}}
        <div class="form__group">
          <label class="form__label">電話番号<span class="form__label--required"></span></label>

          <div class="form__input--tel">
            <input type="text" name="tel1" maxlength="5" value="{{ old('tel1') }}">
            <span>-</span>
            <input type="text" name="tel2" maxlength="5" value="{{ old('tel2') }}">
            <span>-</span>
            <input type="text" name="tel3" maxlength="5" value="{{ old('tel3') }}">
          </div>

          @error('tel1')
            <p class="error">{{ $message }}</p>
          @enderror
          @error('tel2')
            <p class="error">{{ $message }}</p>
          @enderror
          @error('tel3')
            <p class="error">{{ $message }}</p>
          @enderror
        </div>

        {{-- 住所 --}}
        <div class="form__group">
          <label class="form__label">住所<span class="form__label--required"></span></label>

          <div class="form__input-area">
            <input type="text" name="address" value="{{ old('address') }}">
          </div>

          @error('address')
            <p class="error">{{ $message }}</p>
          @enderror
        </div>

        {{-- 建物名（任意） --}}
        <div class="form__group">
          <label class="form__label">建物名</label>

          <div class="form__input-area">
            <input type="text" name="building" value="{{ old('building') }}">
          </div>
        </div>

        {{-- お問い合わせの種類 --}}
        <div class="form__group">
          <label class="form__label">お問い合わせの種類<span class="form__label--required"></span></label>

          <div class="form__input-area">
            <select name="category">
              <option value="">選択してください</option>
              <option value="1" {{ old('category')=='1' ? 'selected' : '' }}>商品のお届けについて</option>
              <option value="2" {{ old('category')=='2' ? 'selected' : '' }}>商品の交換について</option>
              <option value="3" {{ old('category')=='3' ? 'selected' : '' }}>商品トラブル</option>
              <option value="4" {{ old('category')=='4' ? 'selected' : '' }}>ショップへのお問い合わせ</option>
              <option value="5" {{ old('category')=='5' ? 'selected' : '' }}>その他</option>
            </select>
          </div>

          @error('category')
            <p class="error">{{ $message }}</p>
          @enderror
        </div>

        {{-- お問い合わせ内容 --}}
        <div class="form__group">
          <label class="form__label">お問い合わせ内容<span class="form__label--required"></span></label>

          <div class="form__input-area">
            <textarea name="message" placeholder="お問い合わせ内容をご記入ください">{{ old('message') }}</textarea>
          </div>

          @error('message')
            <p class="error">{{ $message }}</p>
          @enderror
        </div>

        {{-- ボタン --}}
        <div class="form__button">
          <button type="submit" class="form__button-submit">確認画面</button>
        </div>

      </form>
    </div>
  </main>
</body>

</html>
