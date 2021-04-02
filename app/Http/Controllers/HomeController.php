<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * ブログ一覧の表示
     */
    public function index()
    {
        $blogs = Blog::with('user')
            ->withCount('comments')
            ->onlyOpen()
            ->orderByDesc('comments_count')
            ->latest('updated_at')  // orderByDesc('updated_at')
            ->get();

        return view('home', compact('blogs'));
    }

    /**
     * ブログの詳細画面の表示
     */
    public function show(Blog $blog)
    {
        // 非公開のものは見られないように
        // if (! $blog->is_open) {
        //     abort(403);
        // }

        abort_unless($blog->is_open, 403); // 反対は abort_if

        return view('blog.show', compact('blog'));
    }
}
