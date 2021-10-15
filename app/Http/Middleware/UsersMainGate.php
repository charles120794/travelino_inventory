<?php

namespace App\Http\Middleware;

use Closure;
use App\User;

class UsersMaingate
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
        /**
         * @return Array
         *
         */
        $moduleAccess = [1, 2, 3, 4, 5];

        /**
         * If active module ID is NOT in or NOT Exists in the list of this Users Module Access
         *
         */
        if( ! in_array(1, $moduleAccess) ) {

            /**
             * Return Redirect with Message
             */
            return redirect(url('/page-error'));
        }

        /**
         * Else Continue to the next request page
         */
        return $next($request);
    }
}
