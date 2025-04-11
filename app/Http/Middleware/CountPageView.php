<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\PageView;
use Illuminate\Support\Facades\Auth;

class CountPageView
{
    public function handle(Request $request, Closure $next)
    {
        $routeName = optional($request->route())->getName();

        $routesToTrack = [
            'nominatif.cabang',
            'nominatif.rekap.kol',
            'nominatif.rekap.produk',
            'nominatif.rekap.ao',
            'nominatif.rekap.instansi',
        ];

        if (in_array($routeName, $routesToTrack)) {
            PageView::create([
                'user_id'    => Auth::id(),
                'route_name' => $routeName,
                'url'        => $request->fullUrl(),
                'ip_address' => $request->ip(),
                'viewed_at'  => now(),
            ]);
        }

        return $next($request);
    }
}
