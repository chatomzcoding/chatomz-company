<?php

namespace App\Http\Middleware;

use App\Http\Helpers\Chatomz\DbChatomz;
use App\Models\Visitor;
use Closure;
use Illuminate\Http\Request;

class VisitorMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        DbChatomz::visitorhit();
        return $next($request);
    }
}
