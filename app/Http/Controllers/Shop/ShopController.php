<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Models\Shop;
use App\Models\VerifyShop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShopController extends Controller
{
    // 会員登録処理
    public function create(Request $request)
    {

        // Validate Input
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:shops,email',
            'shop_phone' => 'required',
            'password' => 'required|min:5|max:30',
            'cpassword' => 'required|min:5|max:30|same:password'
        ]);

        $shop = new Shop();
        $shop->name = $request->name;
        $shop->email = $request->email;
        $shop->shop_phone = $request->shop_phone;
        $shop->password = \Hash::make($request->password);
        $save = $shop->save();

        // Email認証処理
        $last_id = $shop->id;
        $token = $last_id . hash('sha256', \Str::random(120));
        $verifyURL = route('shop.verify', ['token' => $token, 'service' => 'Email_verification']);

        VerifyShop::create([
            'shop_id' => $last_id,
            'token' => $token,
        ]);

        $message = 'Dear <b>' . $request->name . '<b>';
        $message .= 'サインアップのためのタンクは、私たちはあなたのアカウントの設定を完了するためにあなたのメールアドレスを確認する必要があります';

        $mail_data = [
            'recipient' => $request->email,
            'fromEmail' => $request->email,
            'fromName' => $request->name,
            'subject' => 'Email Verification',
            'body' => $message,
            'actionLink' => $verifyURL,

        ];

        \Mail::send('email-template', $mail_data, function ($message) use ($mail_data) {
            $message->to($mail_data['recipient'])->from($mail_data['fromEmail'], $mail_data['fromName'])->subject($mail_data['subject']);
        });

        if ($save) {
            return redirect()->back()->with('success', 'あなたのアカウントを確認する必要があります 私たちはあなたにアクティベーションリンクを送信しましたあなたの電子メールをチェックしてください');
        } else {
            return redirect()->back()->with('fail', '登録に失敗しました');
        }
    }
    // メール認証処理
    public function verify(Request $request)
    {
        $token = $request->token;
        $verifyShop = VerifyShop::where('token', $token)->first();
        if (!is_null($verifyShop)) {
            $shop = $verifyShop->shop;

            if (!$shop->email_verified) {
                $verifyShop->shop->email_verified = 1;
                $verifyShop->shop->save();

                return redirect()->route('shop.login')->with('info', 'メールアドレスが正常に確認されましたログインできるようになりました')
                    ->with('verifiedEmail', $shop->email);
            } else {
                return redirect()->route('shop.login')->with('info', 'あなたのメールアドレスはすでに確認済みです。 これでログインできます')->with('verifiedEmail', $shop->email);
            }
        }
    }
    // ログイン処理
    function check(Request $request)
    {
        // validate input
        $request->validate([
            'email' => 'required|email|exists:shops,email',
            'password' => 'required|min:5|max:30'
        ], [
            'email.exists' => 'このメールは存在しません'
        ]);

        $creds = $request->only('email', 'password');
        if (Auth::guard('shop')->attempt($creds)) {
            return redirect()->route('shop.home');
        } else {
            return redirect()->route('shop.login')->with('fail', 'password若しくはemailが違います。');
        }
    }

    function logout()
    {
        Auth::guard('shop')->logout();
        return redirect('/');
    }
}
