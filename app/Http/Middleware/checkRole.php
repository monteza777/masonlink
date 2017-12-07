<?php

namespace App\Http\Middleware;

use Closure;

class checkRole
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
        if($request->user() === null){
            return redirect('/login');
        }
        $actions = $request->route()->getAction();
        $role = isset($actions['roles']) ? $actions['roles'] : null;

        if($request->user()->hasAnyRole($role) || !$role ){
            return $next($request);
        }
        return redirect('/home');
        // return redirect()->back();
    }
}
