<?php

namespace App\Http\Middleware;

use Closure;

class QuickBasicAuth
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
        if(config('constant.quick_basic_auth')->contains([$request->getUser(),$request->getPassword()])) {
            return $next($request);
        }
        return response('Unauthorized', 401, [
            'WWW-Authenticate' => 'Basic',
        ]);
    }
}
