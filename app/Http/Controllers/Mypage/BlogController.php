<?php

namespace App\Http\Controllers\Mypage;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BlogController extends Controller
{
    /**
     * 自分のブログの一覧表示
     */
    public function index(Request $request)
    {
        // 自分のブログの一覧のみ表示される
        // $blogs = Blog::where('user_id', Auth::user()->id)->get();
        // $blogs = Blog::where('user_id', Auth::id())->get();

        $blogs = $request->user()->blogs;

        return view('mypage.index', compact('blogs'));
    }

    /**
     * ブログ新規登録画面
     */
    public function create()
    {
        return view('mypage.blog.create');
    }

    /**
     * ブログの新規登録処理
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'body' => ['required', 'string'],
            'is_open' => ['nullable'],
        ]);

        $data['is_open'] = $request->boolean('is_open');

        // $blog = Blog::create([
        //     'title' => $data['title'],
        //     'body' => $data['body'],
        //     'is_open' => $data['is_open'],
        //     'user_id' => $request->user()->id,
        // ]);

        $blog = $request->user()->blogs()->create($data);

        dd($blog);
    }
}
