<?php

namespace App\Http\Controllers\Mypage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        // 自分のブログの一覧のみ表示される

        return view('mypage.index');
    }
}
