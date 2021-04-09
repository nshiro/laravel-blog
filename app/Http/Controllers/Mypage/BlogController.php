<?php

namespace App\Http\Controllers\Mypage;

use App\Http\Controllers\Controller;
use App\Http\Requests\BlogSaveRequest;
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
    public function store(BlogSaveRequest $request)
    {
        $data = $request->validated();

        // $blog = Blog::create([
        //     'title' => $data['title'],
        //     'body' => $data['body'],
        //     'is_open' => $data['is_open'],
        //     'user_id' => $request->user()->id,
        // ]);

        $blog = $request->user()->blogs()->create($data);

        return redirect(route('mypage.blog.edit', $blog))->with('message', '新規登録しました');
    }

    /**
     * ブログの編集画面
     */
    public function edit(Blog $blog, Request $request)
    {
        if ($request->user()->isNot($blog->user)) {
            abort(403);
        }

        $data = old() ?: $blog;

        return view('mypage.blog.edit', compact('data'));
    }

    /**
     * ブログの変更処理
     */
    public function update(Blog $blog, BlogSaveRequest $request)
    {
        if ($request->user()->isNot($blog->user)) {
            abort(403);
        }

        $data = $request->validated();

        $blog->update($data);

        return redirect(route('mypage.blog.update', $blog))->with('message', 'ブログを更新しました');
    }
}
