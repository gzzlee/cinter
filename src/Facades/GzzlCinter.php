<?php

declare(strict_types=1);

namespace Gzzl\GzzlCinter\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Class GzzlCinter
 * @method static bool check()
 * @method static bool clear()
 * @see \Gzzl\GzzlCinter\GzzlCinter
 */
class GzzlCinter extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \Gzzl\GzzlCinter\GzzlCinter::class;
    }
}
