<?php

namespace App\Http\Middleware;

use Closure;

class PowhrUser
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

        //these session properties are set in \Powhr\Services\User.php
        $powhrUserEnabled = $request->session()->get('is_powhr', 0);

        //doing a greater than check as different levels maybe introduced
        if ($powhrUserEnabled > 0) {
            return $next($request);
        } else {
            return redirect()->guest('account/login');
        }

    }
}
