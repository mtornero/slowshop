<?php

namespace App\Http\Middleware;

use Closure;
use App\Propel\ConfigQuery;

class SetupIsDone
{
    public function handle($request, Closure $next, $guard = null)
    {
        if (ConfigQuery::create()->find()->count() === 0) {
            if ($request->ajax()) {
                return response('Unauthorized.', 401);
            } else {
                return redirect('/start');
            }
        }

        return $next($request);
    }
}
