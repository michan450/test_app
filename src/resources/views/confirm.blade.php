@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/confirm.css') }}">
@endsection

@section('content')

  <div class="contact-form__content">
    <div class="contact-form__heading">
      <h2>Conform</h2>
    </div>

    <form class="form" action="/contact" method="post">
      @csrf
      <table class="confirm-table">

        <tr>
          <th>お名前</th>
          <td>{{ $contact['name'] }}</td>
        </tr>
        <tr>
          <th>性別</th>
         <td>{{ $contact['gender'] }}</td>
        </tr>
        <tr>
          <th>メールアドレス</th>
          <td>{{ $contact['email'] }}</td>
        </tr>
        <tr>
          <th>電話番号</th>
          <td>{{ $contact['tel'] }}</td>
        </tr>
        <tr>
          <th>住所</th>
          <td>{{ $contact['address'] }}</td>
        </tr>
        <tr>
          <th>建物名</th>
          <td>{{ $contact['building'] }}</td>
        </tr>
        <tr>
          <th>お問い合わせ種類</th>
          <td>{{ $contact['category'] }}</td>
        </tr>
        <tr>
          <th>お問い合わせ内容</th>
          <td>{{ $contact['content'] }}</td>
        </tr>
      </table>

      <input type="hidden" name="name" value="{{ $contact['name'] }}">
      <input type="hidden" name="gender_value" value="{{ $contact['gender_value'] }}">
      <input type="hidden" name="email" value="{{ $contact['email'] }}">
      <input type="hidden" name="tel" value="{{ $contact['tel'] }}">
      <input type="hidden" name="address" value="{{ $contact['address'] }}">
      <input type="hidden" name="building" value="{{ $contact['building'] }}">
      <input type="hidden" name="category_value" value="{{ $contact['category_value'] }}">
      <input type="hidden" name="content" value="{{ $contact['content'] }}">

      <div class="form__buttons">
    <button type="submit" class="btn-submit">送信</button>
    <button type="button" class="btn-return" onclick="history.back();">修正</button>
</div>


    </form>
  </div>

@endsection