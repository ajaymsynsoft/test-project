<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;
use App\Jobs\LogActivityJob;


class ActivityLoggerMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $_user_id=auth()->id();
        $_timest=now();
        $_route=$request->getPathInfo();       
        $_action= "logger";
        Log::info('user_id:'.$_user_id.' accessed:'.$_route.' Timestamp:'.$_timest);
        LogActivityJob::dispatch($_user_id,$_action,$_timest,$_route);
        return $next($request);
    }
}
