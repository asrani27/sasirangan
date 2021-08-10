<?php

namespace App\Http\Middleware;

use Closure;
use App\Traffic;

class Visit
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
        $ip = $request->ip();
        if (Traffic::where('tanggal', today()->format('Y-m-d'))->where('ip', $ip)->count() < 1)
        {
            Traffic::create([
                'tanggal' => today()->format('Y-m-d'),
                'ip' => $ip,
            ]);
        }
        return $next($request);
    }
}
