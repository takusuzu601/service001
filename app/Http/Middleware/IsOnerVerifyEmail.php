<?php

namespace App\Http\Middleware;

use App\Models\Oner;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsOnerVerifyEmail
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if(!Auth::guard('oner')->user()->email_verified){
            Auth::guard('oner')->logout();
            return redirect()->route('oner.login')->with('fail','アクティベーションリンクを送信しました。メールを確認してください')->withInput();
        }

        return $next($request);
    }
}
