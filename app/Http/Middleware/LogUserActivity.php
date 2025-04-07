<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\UserActivity;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\NominatifBranchController;

class LogUserActivity
{
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        if (Auth::check()) {
            $userId = Auth::id();
            $url = $request->fullUrl();
            $action = $this->determineAction($request);
            $parameters = json_encode($request->all());
            $ipAddress = $request->ip();
            $userAgent = $request->header('User-Agent');

            UserActivity::create([
                'user_id' => $userId,
                'action' => $action,
                'url' => $url,
                'parameters' => $parameters,
                'ip_address' => $ipAddress,
                'user_agent' => $userAgent,
            ]);
        }
        return $response;
    }

    private function determineAction($request)
    {
        if ($request->isMethod('GET')) {
            if ($request->query()) {
                return 'view_with_filter';
            }
            return 'view_page';
        } elseif ($request->isMethod('POST')) {
            return 'submit_form';
        }

        return 'other';
    }
}
