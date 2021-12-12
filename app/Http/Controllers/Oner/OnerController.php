<?php

namespace App\Http\Controllers\Oner;

use App\Http\Controllers\Controller;
use App\Models\Oner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OnerController extends Controller
{
    // 会員登録処理
    public function create(Request $request)
    {

        // Validate Input
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:oners,email',
            'oner_phone'=>'required',
            'password' => 'required|min:5|max:30',
            'cpassword' => 'required|min:5|max:30|same:password'
        ]);

        $oner = new Oner();
        $oner->name = $request->name;
        $oner->email = $request->email;
        $oner->oner_phone = $request->oner_phone;
        $oner->password = \Hash::make($request->password);
        $save = $oner->save();

        if ($save) {
            return redirect()->back()->with('success', '登録しました');
        } else {
            return redirect()->back()->with('fail', '登録に失敗しました');
        }
    }
    // ログイン処理
    function check(Request $request)
    {
        // validate input
        $request->validate([
            'email' => 'required|email|exists:oners,email',
            'password' => 'required|min:5|max:30'
        ], [
            'email.exists' => 'このメールは存在しません'
        ]);

        $creds = $request->only('email', 'password');
        if (Auth::guard('oner')->attempt($creds)) {
            return redirect()->route('oner.home');
        } else {
            return redirect()->route('oner.login')->with('fail', 'password若しくはemailが違います。');
        }
    }

    function logout()
    {
        Auth::guard('oner')->logout();
        return redirect('/');
    }
}
