<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class OwnerMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $listing = $request->route('listing');

        if($listing==null) {
            return response()->json(['message'=>'The Listing Record cannot be found '], 404);   
        }

        if($listing->user_id != auth()->user()->id) {
            return response()->json(['message'=>'You are not the owner of this Listing Record'], 401);
        }
        return $next($request);
    }
}
