<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        // Si l'utilisateur n'est PAS connecté OU n'est PAS admin → bloque
        // if (!auth()->check() || auth()->user()->role !== 'admin') {
        //     abort(403, 'Accès réservé aux administrateurs.');
        // }

        return $next($request);
    }
}