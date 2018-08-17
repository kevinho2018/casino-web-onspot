<?php

namespace App\Http\Middleware;

use Closure;
use App\Exceptions\ApiErrorException;

class CasinoVerifyParams
{
    /**
     * Handle an incoming request.
     *
     * @param Closure $next
     * @param array ...$requestParams
     * @return mixed
     * @throws ApiErrorException
     */
    public function handle($request, Closure $next, ...$requestParams)
    {
        foreach ($requestParams as $param) {
            if (! $request->has($param) || $request->get($param) === '') {
                throw new ApiErrorException('required', [$param]);
            }
        }

        return $next($request);
    }
}
