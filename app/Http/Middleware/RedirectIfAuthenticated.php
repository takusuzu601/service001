<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  ...$guards
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {

                // adminのlogin後のリダイレクト先
                if ($guard === 'admin') {
                    return redirect()->route('admin.home');
                }
                // onerのlogin後のリダイレクト先
                if ($guard === 'oner') {
                    return redirect()->route('oner.home');
                }
                //　従来記述コメントアウト
                // return redirect(RouteServiceProvider::HOME);

                //Userのlogin後のリダイレクト先
                return redirect()->route('user.home');
            }
        }

        return $next($request);
    }
}
