@extends('layout')


@section('css')
  <link rel="stylesheet" href="{{ asset('/css/system.css') }}">
@endsection


@section('title')
    管理システム
@endsection


@section('content')
  <div class="container">
    {{-- <form action="{{ route('find') }}" method="POST"> --}}
    <form action="{{ route('find') }}" method="get">
      @csrf
      <div class="side">
        <!-- お名前 -->
        <div class="name side">
          <div class="th">お名前</div>
          {{-- <div class="td"><input type="text" name="fullname" value="{{ request('fullname') }}"></div> --}}
          <div class="td"><input type="text" name="fullname" value="{{ request('fullname') }}"></div>
        </div>
        <!-- 性別 -->
        <div class="gender side">
          <div class="th">性別</div>
          <label><input type="radio" name="gender" value="all" checked>全て</label>
          <label><input type="radio" name="gender" value="male">男性</label>
          <label><input type="radio" name="gender" value="female">女性</label>
        </div>
      </div>
      <!-- 登録日 -->
      <div class="date side">
        <div class="th">登録日</div>
        <input type="text" name="created_at" value="{{ request('created_at') }}"> ~ <input type="text" name="created_at" value="{{ request('created_at') }}">
      </div>
      <!-- メールアドレス -->
      <div class="email side">
        <div class="th">メールアドレス</div>
        <input type="text" name="email" value="{{ request('email') }}">
      </div>
      <button>検索</button>
    </form>
    <a href="{{ route('system') }}">リセット</a>
  </div>

  <!-- result -->
  <div class="container">
    <div class="side">
      <div class="side-item">
        {{-- @if (count($items) >0)
          <p>全{{ $items->total() }}件中
              {{  ($items->currentPage() -1) * $items->perPage() + 1}} - 
              {{ (($items->currentPage() -1) * $items->perPage() + 1) + (count($items) -1)  }}件のデータが表示されています。</p>
        @else
        <p>データがありません。</p>
        @endif  --}}
      </div>
      <div class="side-item">
        {{-- {{ $items->links() }} --}}
        {{-- {{ $data->appends(request()->input())->links() }} --}}
      </div>
      {{-- <p>全35件中　件</p> --}}

  </div>
  <table>
    <tr>
      <th>ID</th>
      <th>お名前</th>
      <th>性別</th>
      <th>メールアドレス</th>
      <th>ご意見</th>
      <th></th>
    </tr>
    @if (isset($items))
    @foreach ($items as $item)
    <tr>
      {{-- <form action="{{ route('delete', ['id' => $task->id]) }}" method="POST"> --}}
      <form action="{{ route('delete', ['id' => $item->id]) }}" method="POST">
      @csrf
        <td>{{ $item->id }}</td>
        <td>{{ $item->fullname }}</td>
        <td>{{ $item->gender }}</td>
        <td>{{ $item->email }}</td>
        <td>{{ $item->opinion }}</td>
        <input type="hidden" name="id" value="{{ $item->id }}">
        <input type="hidden" name="fullname" value="{{ $item->fullname }}">
        <input type="hidden" name="gender" value="{{ $item->gender }}">
        <input type="hidden" name="email" value="{{ $item->email }}">
        <input type="hidden" name="opinion" value="{{ $item->opinion }}">
        <td><button>削除</button></td>
      </form>
    </tr>
    {{-- {{ $form->links() }}  --}}
    @endforeach
    @endif
  </table>
@endsection