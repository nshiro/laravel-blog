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
}
