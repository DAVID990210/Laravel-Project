<?php

namespace App\Http\Middleware;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class InjectInstitutionId
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            $user = Auth::user();
            // Inyecta el institution_id en todas las rutas
            $request->route()->setParameter('institution_id', $user->institution_id);
        }

        return $next($request);
    }
}