<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserDetails
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        // Check if user details are stored in the session
        if (!$request->session()->has('user_details')) {
            // Redirect to user details form
            return redirect()->route('quiz.start')->with('error', 'Please fill in your details to start the quiz.');
        }

        return $next($request);
    }
}
