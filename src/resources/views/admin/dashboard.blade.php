@extends('layouts.app')
<header class="admin-header">
    <h1 class="admin-logo">FashionablyLate</h1>
    <form method="POST" action="{{ route('logout') }}" class="logout-form">
        @csrf
        <button type="submit" class="btn-logout">ログアウト</button>
    </form>
</header>
<div class="admin-subheader">
    admin
</div>

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin.css') }}">
@endsection

@section('content')
   
<div class="search-container">
    {{-- 検索フォーム --}}
    <form method="GET" action="{{ route('admin.dashboard') }}" class="search-form">
        
        <div class="search-row">
        <input type="text" name="name" placeholder="名前" value="{{ request('name') }}">
        <input type="email" name="email" placeholder="メール" value="{{ request('email') }}">
        <select name="gender" class="search-select">
            <option value="all">性別</option>
            <option value="男性" {{ request('gender')=='男性'?'selected':'' }}>男性</option>
            <option value="女性" {{ request('gender')=='女性'?'selected':'' }}>女性</option>
            <option value="その他" {{ request('gender')=='その他'?'selected':'' }}>その他</option>
        </select>
        <select name="category" class="search-select">
            <option value="">お問い合わせ種類</option>
            <option value="商品のお届けについて" {{ request('category')=='商品のお届けについて'?'selected':'' }}>商品のお届けについて</option>
            <option value="商品の交換について" {{ request('category')=='商品の交換について'?'selected':'' }}>商品の交換について</option>
            <option value="商品トラブル" {{ request('category')=='商品トラブル'?'selected':'' }}>商品トラブル</option>
            <option value="ショップへのお問い合わせ" {{ request('category')=='ショップへのお問い合わせ'?'selected':'' }}>ショップへのお問い合わせ</option>
            <option value="その他" {{ request('category')=='その他'?'selected':'' }}>その他</option>
        </select>
        <input type="date" name="date" value="{{ request('date') }}">
        <button type="submit" class="btn-search">検索</button>
        <a href="{{ route('admin.dashboard') }}" class="btn-reset">リセット</a>
    </form>

    {{-- CSVエクスポート --}}
    <div class="export-row">
      <a href="{{ route('admin.export', request()->query()) }}" class="btn-export">CSVエクスポート</a>
    </div>
    {{-- お問い合わせ一覧 --}}
    <div class="table-container">
    <table class="admin-table">
        <thead>
            <tr>
                <th>お名前</th>
                <th>性別</th>
                <th>メールアドレス</th>
                <th>お問い合わせ内容</th>
                <th>詳細</th>
            </tr>
        </thead>
        <tbody>
            @foreach($contacts as $contact)
            <tr>
                <td>{{ $contact->name }}</td>
                <td>{{ $contact->gender }}</td>
                <td>{{ $contact->email }}</td>
                <td>{{ Str::limit($contact->content, 30) }}</td>
                <td>
                    <button class="btn-detail"
                    type="button"
    data-name="{{ $contact->name }}"
    data-gender="{{ $contact->gender }}"
    data-email="{{ $contact->email }}"
    data-tel="{{ $contact->tel }}"
    data-address="{{ $contact->address }}"
    data-building="{{ $contact->building }}"
    data-category="{{ $contact->category }}"
    data-content="{{ $contact->content }}">
  詳細
</button>

                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $contacts->links() }}

</div>

{{-- 詳細モーダル --}}
<div id="modal" style="display:none;">
    <div class="modal-content">
        <span id="close">&times;</span>

        <table class="modal-table">
            <tr><th>お名前</th><td id="modal-name"></td></tr>
            <tr><th>性別</th><td id="modal-gender"></td></tr>
            <tr><th>メールアドレス</th><td id="modal-email"></td></tr>
            <tr><th>電話番号</th><td id="modal-tel"></td></tr>
            <tr><th>住所</th><td id="modal-address"></td></tr>
            <tr><th>建物名</th><td id="modal-building"></td></tr>
            <tr><th>お問い合わせの種類</th><td id="modal-category"></td></tr>
            <tr><th>お問い合わせ内容</th><td id="modal-content"></td></tr>
        </table>

        <button id="delete-btn" data-id="" type="button" style="margin-top:10px; background:red; color:#fff; border:none; padding:6px 12px; border-radius:6px; cursor:pointer;">
           削除
        </button>

    </div>
</div>
<script>
document.addEventListener('DOMContentLoaded', function() {
  const modal = document.getElementById('modal');
  const closeBtn = document.getElementById('close');
  const deleteBtn = document.getElementById('delete-btn');

  
  document.querySelectorAll('.btn-detail').forEach(button => {
    button.addEventListener('click', () => {
      const id = button.dataset.id;

      modal.querySelector('#modal-name').textContent = button.dataset.name;
      modal.querySelector('#modal-gender').textContent = button.dataset.gender;
      modal.querySelector('#modal-email').textContent = button.dataset.email;
      modal.querySelector('#modal-tel').textContent = button.dataset.tel;
      modal.querySelector('#modal-address').textContent = button.dataset.address;
      modal.querySelector('#modal-building').textContent = button.dataset.building;
      modal.querySelector('#modal-category').textContent = button.dataset.category;
      modal.querySelector('#modal-content').textContent = button.dataset.content;

      modal.style.display = 'flex';

      
      deleteBtn.dataset.id = id;
    });
  });

  
  closeBtn.addEventListener('click', () => {
    modal.style.display = 'none';
  });

  
  window.addEventListener('click', (e) => {
    if(e.target == modal) modal.style.display = 'none';
  });

  
  deleteBtn.addEventListener('click', () => {
    const id = deleteBtn.dataset.id;

    if (!confirm('本当に削除しますか？')) return;

    fetch(`/admin/delete/${id}`, {
      method: 'DELETE',
      headers: {
        'X-CSRF-TOKEN': '{{ csrf_token() }}',
        'Accept': 'application/json',
        'Content-Type': 'application/json'
      }
    })
    .then(response => response.json())
    .then(data => {
      if(data.success){
        alert('削除しました');
        
        const row = document.querySelector(`.btn-detail[data-id="${id}"]`).closest('tr');
        row.remove();
        modal.style.display = 'none';
      } else {
        alert('削除できませんでした');
      }
    })
    .catch(err => {
      console.error(err);
      alert('削除中にエラーが発生しました');
    });
  });
});
</script>


@endsection