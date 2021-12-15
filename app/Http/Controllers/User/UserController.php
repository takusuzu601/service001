<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\VerifyUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    // 会員登録処理
    public function create(Request $request)
    {

        // Validate Input
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:5|max:30',
            'cpassword' => 'required|min:5|max:30|same:password'
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = \Hash::make($request->password);
        $save = $user->save();

        // Email認証処理
        $last_id = $user->id;
        $token = $last_id . hash('sha256', \Str::random(120));
        $verifyURL = route('user.verify', ['token' => $token, 'service' => 'Email_verification']);

        VerifyUser::create([
            'user_id' => $last_id,
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
        $verifyUser = VerifyUser::where('token', $token)->first();
        if (!is_null($verifyUser)) {
            $user = $verifyUser->user;

            if (!$user->email_verified) {
                $verifyUser->user->email_verified = 1;
                $verifyUser->user->save();

                return redirect()->route('user.login')->with('info', 'メールアドレスが正常に確認されましたログインできるようになりました')
                    ->with('verifiedEmail', $user->email);
            } else {
                return redirect()->route('user.login')->with('info', 'あなたのメールアドレスはすでに確認済みです。 これでログインできます')->with('verifiedEmail', $user->email);
            }
        }
    }
    // ログイン処理
    function check(Request $request)
    {
        // validate input
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required|min:5|max:30'
        ], [
            'email.exists' => 'このメールは存在しません'
        ]);

        $creds = $request->only('email', 'password');
        if (Auth::guard('web')->attempt($creds)) {
            return redirect()->route('user.home');
        } else {
            return redirect()->route('user.login')->with('fail', 'password若しくはemailが違います。');
        }
    }

    function logout()
    {
        Auth::guard('web')->logout();
        return redirect('/');
    }
}
