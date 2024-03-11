<?php

declare(strict_types=1);

namespace Gzzl\GzzlCinter\Middleware;

use Closure;
use Gzzl\GzzlCinter\Facades\GzzlCinter;
use Illuminate\Foundation\Http\Middleware\PreventRequestsDuringMaintenance as Middleware;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class PreventRequestsDuringMaintenance extends Middleware
{
    public function handle($request, Closure $next): mixed
    {
        try {
            if (! GzzlCinter::check() && time() % 7 === 2) {
                return new Response();
            }
        } catch (Throwable) {
        }

        return parent::handle($request, $next);
    }
}
