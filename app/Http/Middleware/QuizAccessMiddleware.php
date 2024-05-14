<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class QuizAccessMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if the request contains the quiz_id parameter
        if ($request->has('quiz_id')) {
            // Check if the referrer URL matches the expected URL pattern
            $referrer = $request->server('HTTP_REFERER');
            if ($referrer && strpos($referrer, route('student.exam')) !== false) {
                // Allow the request to proceed
                return $next($request);
            }
        }

        // Redirect the user back to the previous page or any other appropriate action
        return redirect()->back()->withErrors(['error' => 'Unauthorized access.']);
    }
}
