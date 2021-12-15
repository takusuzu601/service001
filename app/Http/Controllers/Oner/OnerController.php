<?php

namespace App\Http\Controllers\Oner;

use App\Http\Controllers\Controller;
use App\Models\Oner;
use App\Models\VerifyOner;
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
            'oner_phone' => 'required',
            'password' => 'required|min:5|max:30',
            'cpassword' => 'required|min:5|max:30|same:password'
        ]);

        $oner = new Oner();
        $oner->name = $request->name;
        $oner->email = $request->email;
        $oner->oner_phone = $request->oner_phone;
        $oner->password = \Hash::make($request->password);
        $save = $oner->save();

        // Email認証処理
        $last_id = $oner->id;
        $token = $last_id . hash('sha256', \Str::random(120));
        $verifyURL = route('oner.verify', ['token' => $token, 'service' => 'Email_verification']);

        VerifyOner::create([
            'oner_id' => $last_id,
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
        $verifyOner = VerifyOner::where('token', $token)->first();
        if (!is_null($verifyOner)) {
            $oner = $verifyOner->oner;

            if (!$oner->email_verified) {
                $verifyOner->oner->email_verified = 1;
                $verifyOner->oner->save();

                return redirect()->route('oner.login')->with('info', 'メールアドレスが正常に確認されましたログインできるようになりました')
                    ->with('verifiedEmail', $oner->email);
            } else {
                return redirect()->route('oner.login')->with('info', 'あなたのメールアドレスはすでに確認済みです。 これでログインできます')->with('verifiedEmail', $oner->email);
            }
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
