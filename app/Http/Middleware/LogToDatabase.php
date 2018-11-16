<?php

namespace App\Http\Middleware;

use Closure;
use App\RequestLog;

class LogToDatabase
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
        $status = http_response_code();
        $method = $request->method();
        $uri = $request->path();

        $log = new RequestLog();
        $log->http_status_code = $status;
        $log->request_method = $method;
        $log->route = $uri;

        $log->save();

        return $next($request);

    }
}
