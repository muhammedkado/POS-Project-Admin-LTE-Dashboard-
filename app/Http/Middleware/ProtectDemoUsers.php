<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ProtectDemoUsers
{
    /**
     * Block update/delete of the seeded demo accounts so the public demo
     * always has working login credentials.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->route('user');

        if ($user && in_array($user->email, config('demo.protected_emails', []), true)) {
            return redirect()
                ->route('dashboard.users.index')
                ->with('error', __('Demo account is protected and cannot be changed.'));
        }

        return $next($request);
    }
}
