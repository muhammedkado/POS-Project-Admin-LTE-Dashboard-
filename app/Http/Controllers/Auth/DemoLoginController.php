<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * One-click demo sign-in used by the portfolio (mkado.dev).
 *
 * GET /{locale}/demo/{as?} logs into one of the seeded demo accounts listed in
 * config/demo.php ('accounts') and lands on the dashboard. The credentials are
 * public anyway; this only removes the typing. Unknown keys 404 — an arbitrary
 * user can never be chosen through this route.
 */
class DemoLoginController extends Controller
{
    public function __invoke(Request $request, string $as = 'admin')
    {
        $email = config("demo.accounts.$as");
        abort_if(! $email, 404);

        $user = User::where('email', $email)->first();
        abort_if(! $user, 404);

        Auth::logout();
        Auth::login($user);
        $request->session()->regenerate();

        return redirect()->route('dashboard.index');
    }
}
