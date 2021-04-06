@extends('layouts.app')

@section('content')


<h1>ユーザー登録</h1>

<form method="post">
@csrf


@include('inc.error')


名前：<input type="text" name="name" value="{{ old('name') }}">
<br>
メルアド：<input type="text" name="email" value="{{ old('email') }}">
<br>
パスワード：<input type="password" name="password">
<br>
都道府県：<x-pref class="bb" id="myid" :default="old('pref')" />
<br>
住所：<input type="text" name="address" value="{{ old('address') }}">
東京都の場合は必須。

<br><br>
<input type="submit" value="　送信する　">

</form>

@endsection