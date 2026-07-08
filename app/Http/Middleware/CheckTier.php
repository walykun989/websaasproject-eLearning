<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckTier
{
    public function handle(Request $request, Closure $next, string $requiredTier): Response
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $user = auth()->user();
        $tierHierarchy = ['free' => 0, 'apik' => 1, 'sangar' => 2];

        if ($tierHierarchy[$user->tier] < $tierHierarchy[$requiredTier]) {
            return redirect()->route('peserta.pricing')
                ->with('error', 'Upgrade your tier to access this content');
        }

        return $next($request);
    }
}
