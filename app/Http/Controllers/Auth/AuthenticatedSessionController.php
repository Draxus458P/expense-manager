<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     *
     * This method shows the login form to the user.
     * It returns the view located at `resources/views/auth/login.blade.php`.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     *
     * This method processes the login form submission.
     * It uses the LoginRequest to validate and authenticate the user.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        // Authenticate the user using the credentials provided in the LoginRequest
        $request->authenticate();

        // Regenerate the session ID to prevent session fixation attacks
        $request->session()->regenerate();

        // Retrieve the authenticated user
        $user = Auth::user();

        // Check the user's role and redirect accordingly
        if ($user->role == 'admin') {
            // Redirect admin users to the admin dashboard
            return redirect()->intended('/admin/dashboard'); // Adjusted path
        }

        // Redirect regular users to the user dashboard
        return redirect()->intended('/dashboard');
    }

    /**
     * Destroy an authenticated session.
     *
     * This method logs out the user and invalidates their session.
     * It also regenerates the CSRF token for security.
     */
    public function destroy(Request $request): RedirectResponse
    {
        // Log out the user
        Auth::guard('web')->logout();

        // Invalidate the current session
        $request->session()->invalidate();

        // Regenerate the CSRF token to prevent CSRF attacks
        $request->session()->regenerateToken();

        // Redirect the user to the home page after logout
        return redirect('/');
    }
}
