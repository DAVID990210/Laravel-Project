<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CheckSpecificInstitution
{
    public function handle(Request $request, Closure $next, $institution_id)
    {
        $user = Auth::user();
        $userInstitutionId = $user->institution_id;

        if ($userInstitutionId != $institution_id) {
            return redirect()->route('dashboard')->with('error', 'No tienes acceso a esta sección.');
        }

        return $next($request);
    }
}
