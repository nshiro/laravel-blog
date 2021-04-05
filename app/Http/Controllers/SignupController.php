<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class SignupController extends Controller
{
    /**
     * ユーザー登録フォーム
     */
    public function index()
    {
        return view('signup');
    }

    /**
     * ユーザー登録処理
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:20'],
            'email' => ['required', 'email:filter', Rule::unique('users')],
            'password' => ['required', 'string', 'min:8'],
        ]);

        $request->dd();
    }
}
