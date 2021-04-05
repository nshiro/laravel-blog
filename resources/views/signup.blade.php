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


<x-pref name="太郎" gender="男性" />


<br><br>
<input type="submit" value="　送信する　">

</form>

@endsection