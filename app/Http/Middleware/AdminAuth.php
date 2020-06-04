<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;

class AdminAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
     protected $auth;

    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    public function handle($request, Closure $next)
    {
         //   dd($this->auth);
        if($this->auth->user()->user_type=='admin')
        {
           // dd('store');

        } else {
            if ($request->ajax()) {
                return redirect('unauthorized');
            } else {
                return redirect('unauthorized');
            }
        }

        return $next($request);
    }
}
