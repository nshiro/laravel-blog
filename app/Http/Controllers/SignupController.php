<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Rules\TokyoAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        // $request->dd();

        //「半角」英数字を「全角」に変換
        // $address = mb_convert_kana($request->input('address'), 'A');
        // $request->merge(compact('address'));

        $data = $request->validate([
            'name' => ['required', 'string', 'max:20'],
            'email' => ['required', 'email:filter', Rule::unique('users')],
            'password' => ['required', 'string', 'min:8'],
            // 'address' => ['required_if:pref,東京都'],
            // 'address' => [new TokyoAddress($request->input('pref'))]
        ]);

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);

        Auth::login($user);

        return redirect('mypage');
    }
}
