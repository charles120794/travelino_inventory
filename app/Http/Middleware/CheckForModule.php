<?php

namespace App\Http\Middleware;

use Gate;
use Closure;
use App\Model\Settings\SystemModule;

class CheckForModule
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
        $response = $next($request);

        return $response;
    }
}
