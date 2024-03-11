<?php

declare(strict_types=1);

namespace Gzzl\GzzlCinter;

use Gzzl\GzzlCinter\Commands\GzzlLinkCommand;
use Gzzl\GzzlCinter\Commands\GzzlUnlinkCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class GzzlCinterServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('gzzl-cinter')
            ->hasCommands([
                GzzlLinkCommand::class,
                GzzlUnlinkCommand::class,
            ]);
    }
}
