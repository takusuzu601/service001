<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    // 会員登録処理
    public function create(Request $request){

        // Validate Input
        $request->validate([
            'name'=>'required',
            'email'=>'required|email|unique:users,email',
            'password'=>'required|min:5|max:30',
            'cpassword'=>'required|min:5|max:30|same:password'
        ]);

        $user=new User();
        $user->name=$request->name;
        $user->email=$request->email;
        $user->password=\Hash::make($request->password);
        $save=$user->save();

        if($save){
            return redirect()->back()->with('success','登録しました');
        }else{
            return redirect()->back()->with('fail','登録に失敗しました');
        }
    }
    // ログイン処理
    function check(Request $request){
        // validate input
        $request->validate([
            'email'=>'required|email|exists:users,email',
            'password'=>'required|min:5|max:30'
        ],[
            'email.exists'=>'このメールは存在しません'
        ]);

        $creds=$request->only('email','password');
        if(Auth::guard('web')->attempt($creds)){
            return redirect()->route('user.home');
            
        }else{
            return redirect()->route('user.login')->with('fail','password若しくはemailが違います。');
        }
    }

    function logout(){
        Auth::guard('web')->logout();
        return redirect('/');
    }
}
