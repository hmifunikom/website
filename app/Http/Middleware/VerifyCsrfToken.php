<?php namespace HMIF\Http\Middleware;

use Hash;
use Config;
use Closure;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as BaseVerifier;
use Log;

class VerifyCsrfToken extends BaseVerifier {

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
        if($request->is('queue/*') && $request->method() === $request::METHOD_POST)
        {
            if(Hash::check(Config::get('queue.connections.iron.project'), $request->get('token')))
            {
                return $next($request);
            }
        }

		return parent::handle($request, $next);
	}

}
