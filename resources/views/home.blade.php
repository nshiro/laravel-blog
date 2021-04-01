@extends('layouts.app')

@section('content')


<h1>ブログ一覧</h1>

<ul>
    @foreach($blogs as $blog)
    {{-- <li>{{ $blog->title }}　{{ $blog->user()->first()->name }}</li> --}}
    <li>{{ $blog->title }}　{{ $blog->user->name }}</li>

    {{-- <li>{{ $blog->title }}　{{ $blog->user ? $blog->user->name : '（退会者）' }}</li> <!-- 昔ながらの方法 --> --}}

    {{-- <li>{{ $blog->title }}　{{ $blog->user->name ?? '（退会者）' }}</li> <!-- Null 合体演算子（PHP7～） --> --}}

    {{-- <li>{{ $blog->title }}　{{ $blog->user?->name }}</li> <!-- Nullsafe演算子（PHP8～） --> --}}

    {{-- <li>{{ $blog->title }}　{{ optional($blog->user)->name }}</li> <!-- Laravel ヘルパー関数 --> --}}

    @endforeach
</ul>


@endsection
