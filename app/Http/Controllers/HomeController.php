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
        $blogs = Blog::with('user')->get();

        return view('home', compact('blogs'));
    }
}
