<?php

namespace App\Http\Controllers\Mypage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class UserLoginController extends Controller
{
    /**
     * ユーザーログイン画面
     */
    public function index()
    {
        return view('mypage.login');
    }

    /**
     * ログイン処理
     */
    public function login(Request $request)
    {
        $data = $request->validate([
            'email' => ['required', 'email:filter'],
            'password' => ['required', 'string'],
        ]);

        if (Auth::attempt($data)) {
            $request->session()->regenerate();

            return redirect('mypage');
        }

        // throw ValidationException::withMessages([
        //     'email' => 'メールアドレスかパスワードが間違っていますよ。'
        // ]);

        return back()->withErrors([
            'email' => 'メールアドレスかパスワードが間違っています。',
        ])->withInput();
    }
}
