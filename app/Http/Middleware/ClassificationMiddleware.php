<?php

namespace App\Http\Middleware;

use Closure;
//追加
use App\Classification;



class ClassificationMiddleware
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
        $classifications=Classification::get();
        //$request->setContent($classifications);
        return $next($request);
    }
}
