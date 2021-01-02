<?php
namespace App\Http\Middleware;

use Closure;
use Symfony\Component\HttpFoundation\Response;

class CheckUserDetails
{
	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response|mixed
	 */
	public function handle($request, Closure $next)
	{
		$hasDetails	= request()->user->details()->count();
		if($hasDetails>0) {
			return response('', Response::HTTP_FORBIDDEN);
		}
		return $next($request);
	}
}
