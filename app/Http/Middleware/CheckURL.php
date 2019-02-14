<?php

namespace App\Http\Middleware;

use Closure;
use App\Subscriber;

/**
* Перевірка чи існує
* і активний URL
* за яким хоче перейти користувач 
*/
class CheckURL
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $token = $request->route('id');

        if (!Subscriber::validateToken($token)) {
            abort(403);
        }

        return $next($request);
    }
}
