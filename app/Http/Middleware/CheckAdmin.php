<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $adminCount = User::where('role', 'admin')->count();

        if ($adminCount > 0) {
            abort(403, 'Pendaftaran ditutup karena sudah ada Admin');
        }
        
        return $next($request);
    }
}
