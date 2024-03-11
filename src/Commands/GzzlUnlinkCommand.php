<?php

declare(strict_types=1);

namespace Gzzl\GzzlCinter\Commands;

use Gzzl\GzzlCinter\Controllers\Controller as GzzlController;
use Gzzl\GzzlCinter\Middleware\PreventRequestsDuringMaintenance as GzzlPreventRequestsDuringMaintenance;
use Gzzl\GzzlCinter\Models\Model as GzzlModel;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Model as SourceModel;
use Illuminate\Foundation\Http\Middleware\PreventRequestsDuringMaintenance as SourcePreventRequestsDuringMaintenance;
use Illuminate\Routing\Controller as SourceController;
use function count;

class GzzlUnlinkCommand extends Command
{
    protected $signature = 'gzzl:unlink';

    protected $description = 'GzzUnlink';

    public function handle(): void
    {
        $middlewareFile = app_path('Http/Middleware/PreventRequestsDuringMaintenance.php');
        $controllerFile = app_path('Http/Controllers/Controller.php');
        $modelFiles = glob(app_path('Models/*.php'), GLOB_NOSORT);

        if (is_file($middlewareFile)) {
            $this->info('Middleware...');

            file_put_contents($middlewareFile,
                str_replace(
                    GzzlPreventRequestsDuringMaintenance::class,
                    SourcePreventRequestsDuringMaintenance::class,
                    file_get_contents($middlewareFile),
                ),
                LOCK_EX);
        }

        if (is_file($controllerFile)) {
            $this->info('Controller...');

            file_put_contents($controllerFile,
                str_replace(
                    GzzlController::class,
                    SourceController::class,
                    file_get_contents($controllerFile),
                ),
                LOCK_EX);
        }

        if (count($modelFiles) > 0) {
            $this->info('Models...');

            foreach ($modelFiles as $modelFile) {
                file_put_contents($modelFile,
                    str_replace(
                        GzzlModel::class,
                        SourceModel::class,
                        file_get_contents($modelFile),
                    ),
                    LOCK_EX);
            }
        }

        $this->info('Ready!');
    }
}
