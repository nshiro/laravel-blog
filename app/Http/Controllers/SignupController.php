<?php

namespace App\Http\Controllers;

use App\Rules\TokyoAddress;
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
        // $request->dd();

        //「半角」英数字を「全角」に変換
        // $address = mb_convert_kana($request->input('address'), 'A');
        // $request->merge(compact('address'));

        $request->validate([
            'name' => ['required', 'string', 'max:20'],
            'email' => ['required', 'email:filter', Rule::unique('users')],
            'password' => ['required', 'string', 'min:8'],
            // 'address' => ['required_if:pref,東京都'],
            'address' => [new TokyoAddress($request->input('pref'))]
        ]);

        // ■ 必須系（required, filled, accepted などの存在チェック系）
        // とにかくチェックが走る

        // ■ 一般系
        // (1) 入力があるときは、チェックは走る（既に他でエラーが出ている場合は除く）
        // (2) 項目は存在して、値が null の場合、チェックは走る。（但し、'nullable'の指定があれば走らない）
        // (3) 項目が存在しない場合や空文字列の場合、チェックは走らない。

        $request->dd();
    }
}
