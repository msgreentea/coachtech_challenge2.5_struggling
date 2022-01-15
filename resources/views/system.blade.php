@extends('layout')


@section('css')
  <link rel="stylesheet" href="{{ asset('/css/system.css') }}">
@endsection


@section('title')
    管理システム
@endsection


@section('content')
  <div class="container">
    <form action="{{ route('find') }}" method="POST">
      @csrf
      <div class="side">
        <!-- name -->
        <div class="name side">
          <div class="th">お名前</div>
          <div class="td"><input type="text" name="fullname" value="{{ request('fullname') }}"></div>
        </div>
        <!-- gender -->
        <div class="gender side">
          <div class="th">性別</div>
          <label><input type="radio" name="gender" value="" checked>全て</label>
          <label><input type="radio" name="gender" value="1">男性</label>
          <label><input type="radio" name="gender" value="2">女性</label>
        </div>
      </div>
      <!-- created_at -->
      <div class="date side">
        <div class="th">登録日</div>
        <input type="text" name="created_at" value="{{ request('created_at') }}"> ~ <input type="text" name="created_at" value="{{ request('created_at') }}">
      </div>
      <!-- email -->
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
    <div class="between">
      <div class="side">
        {{-- @if (count($items->result) >0)
        <p>全{{ $items->total() }}件中</p>
          <p>
            {{  ($items->currentPage() -1) * $items->perPage() + 1}} -
            {{ (($items->currentPage() -1) * $items->perPage() + 1) + (count($items) -1)  }}件
          </p>
        @else
          <p>データがありません。</p>
        @endif --}}
      </div>
      <div>
        {{-- {{ $results->links() }} --}}
        {{-- {{ $items->appends(request()->input())->links() }} --}}
      </div>


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
    @if (isset($results))
    {{-- <p class="paginate">{{ $results->links() }}</p> --}}
    @foreach ($results as $result)
    <tr>
      <form action="{{ route('delete', ['id' => $result->id]) }}" method="POST">
      @csrf
        <td>{{ $result->id }}</td>
        <td>{{ $result->fullname }}</td>
        @if ($result->gender == 1)
            <td>男性</td>
        @endif
        @if ($result->gender == 2)
            <td>女性</td>
        @endif
        <td>{{ $result->email }}</td>
        <td>{{ Str::limit($result->opinion, 50, '…') }}</td>
        <input type="hidden" name="id" value="{{ $result->id }}">
        <input type="hidden" name="fullname" value="{{ $result->fullname }}">
        <input type="hidden" name="gender" value="{{ $result->gender }}">
        <input type="hidden" name="email" value="{{ $result->email }}">
        <input type="hidden" name="opinion" value="{{ $result->opinion }}">
        <td><button class="btn">削除</button></td>
      </form>
    </tr>
    @endforeach
    @endif
  </table>
@endsection