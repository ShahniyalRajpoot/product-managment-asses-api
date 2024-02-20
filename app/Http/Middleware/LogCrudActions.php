<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class LogCrudActions
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
//        $routeName = $request->route()->getName();
        $logData = [
            'user_id' => auth()->id(),
            'action' => $request->path(),
            'loggable_type' => $request->method(),
            'loggable_id' => auth()->id(),
        ];
        DB::table('user_logs')->insert($logData);
        return $next($request);

    }



}
