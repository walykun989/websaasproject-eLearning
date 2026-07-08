<?php

namespace App\Http\Middleware;

use App\Models\Material;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckMaterialAccess
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $materialId = $request->route('material');

        if (!$materialId) {
            return $next($request);
        }

        $material = Material::find($materialId);

        if (!$material) {
            abort(404);
        }

        $user = auth()->user();
        $tierHierarchy = ['free' => 0, 'apik' => 1, 'sangar' => 2];

        if ($tierHierarchy[$user->tier] < $tierHierarchy[$material->tier_required]) {
            return redirect()->route('peserta.pricing')
                ->with('paywall', true)
                ->with('material_id', $materialId)
                ->with('error', 'Upgrade to ' . ucfirst($material->tier_required) . ' tier to access this material');
        }

        return $next($request);
    }
}
