@extends('layout')


@section('css')
  <link rel="stylesheet" href="{{ asset('/css/share.css') }}">
  <link rel="stylesheet" href="{{ asset('/css/confirm.css') }}">
@endsection


@section('title')
  内容確認
@endsection


@section('content')
  <form action="{{ route('add') }}" method="POST">
    @csrf
    <table>
      <tr>
        <th>お名前</th>
        <td>{{ $fullname }}</td>
        <input type="hidden" name="fullname" value="{{$fullname}}">
      </tr>
      <tr>
        <th>性別</th>
        {{-- <td>{{ $gender }}</td> --}}
        @if ($gender == 1)
            <td>男性</td>
        @endif
        @if ($gender == 2 )
            <td>女性</td>
        @endif
        <input type="hidden" name="gender" value="{{$gender}}">
      </tr>
      <tr>
        <th>メールアドレス</th>
        <td>{{ $email }}</td>
        <input type="hidden" name="email" value="{{$email}}">
      </tr>
      <tr>
        <th>郵便番号</th>
        <td>{{ $postcode }}</td>
        <input type="hidden" name="postcode" value="{{$postcode}}">
      </tr>
      <tr>
        <th>住所</th>
        <td>{{ $address }}</td>
        <input type="hidden" name="address" value="{{$address}}">
      </tr>
      <tr>
        <th>建物</th>
        <td>{{ $building_name }}</td>
        <input type="hidden" name="building_name" value="{{$building_name}}">
      </tr>
      <tr>
        <th>ご意見</th>
        <td>{{ $opinion }}</td>
        <input type="hidden" name="opinion" value="{{$opinion}}">
      </tr>
    </table>
    <button>送信する</button>
  </form>
  <a href="{{ route('index') }}">修正する</a>
@endsection