<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Str;

class MakeCrudCommand extends Command
{
    protected $signature = 'make:crud {name}
        {--route : Register resource route automatically}';

    protected $description = 'Generate full CRUD (model, migration, controller, requests, views, factory, test)';

    protected Filesystem $files;

    public function __construct(Filesystem $files)
    {
        parent::__construct();
        $this->files = $files;
    }

    public function handle(): int
    {
        $name = Str::studly($this->argument('name'));

        $replacements = $this->replacements($name);

        $this->makeModel($replacements);
        $this->makeMigration($replacements);
        $this->makeFactory($replacements);
        $this->makeRequests($replacements);
        $this->makeController($replacements);
        $this->makeViews($replacements);
        $this->makeTest($replacements);

        if ($this->option('route')) {
            $this->registerRoute($replacements);
        }

        $this->info('CRUD generated successfully.');

        return self::SUCCESS;
    }

    /* ---------------- Core replacements ---------------- */

    protected function replacements(string $model): array
    {
        return [
            '{{ model }}' => $model,
            '{{ variable }}' => Str::camel($model),
            '{{ collection }}' => Str::plural(Str::camel($model)),
            '{{ table }}' => Str::snake(Str::pluralStudly($model)),
            '{{ route }}' => Str::kebab(Str::pluralStudly($model)),
            '{{ view }}' => Str::kebab(Str::pluralStudly($model)),
            '{{ title_singular }}' => Str::headline($model),
            '{{ title_plural }}' => Str::headline(Str::pluralStudly($model)),
        ];
    }

    /* ---------------- Generators ---------------- */

    protected function makeModel(array $r): void
    {
        $this->copyStub('model.stub', app_path("Models/{$r['{{ model }}']}.php"), $r);
    }

    protected function makeMigration(array $r): void
    {
        $name = 'create_' . $r['{{ table }}'] . '_table.php';
        $path = database_path('migrations/' . date('Y_m_d_His') . '_' . $name);

        $this->copyStub('migration.stub', $path, $r);
    }

    protected function makeFactory(array $r): void
    {
        $this->copyStub(
            'factory.stub',
            database_path("factories/{$r['{{ model }}']}Factory.php"),
            $r
        );
    }

    protected function makeRequests(array $r): void
    {
        $base = app_path("Http/Requests/{$r['{{ model }}']}");

        $this->files->ensureDirectoryExists($base);

        $this->copyStub('store-request.stub', "$base/StoreRequest.php", $r);
        $this->copyStub('update-request.stub', "$base/UpdateRequest.php", $r);
    }

    protected function makeController(array $r): void
    {
        $this->copyStub(
            'controller.stub',
            app_path("Http/Controllers/{$r['{{ model }}']}Controller.php"),
            $r
        );
    }

    protected function makeViews(array $r): void
    {
        $dir = resource_path("views/{$r['{{ view }}']}");

        $this->files->ensureDirectoryExists($dir);

        $this->copyStub('index.stub', "$dir/index.blade.php", $r);
        $this->copyStub('form.stub', "$dir/form.blade.php", $r);
    }

    protected function makeTest(array $r): void
    {
        $this->copyStub(
            'test.stub',
            base_path("tests/Feature/{$r['{{ model }}']}CrudTest.php"),
            $r
        );
    }

    /* ---------------- Utilities ---------------- */

    protected function copyStub(string $stub, string $destination, array $replacements): void
    {
        if ($this->files->exists($destination)) {
            $this->warn("Skipped (exists): $destination");
            return;
        }

        $content = $this->files->get(base_path("stubs/crud/$stub"));
        $content = str_replace(array_keys($replacements), array_values($replacements), $content);

        $this->files->put($destination, $content);
        $this->line("Created: $destination");
    }

    protected function registerRoute(array $r): void
    {
        $route = "Route::resource('{$r['{{ route }}']}', \\App\\Http\\Controllers\\{$r['{{ model }}']}Controller::class);";

        $path = base_path('routes/web.php');

        if (! str_contains(file_get_contents($path), $route)) {
            file_put_contents($path, PHP_EOL . $route . PHP_EOL, FILE_APPEND);
            $this->info('Route registered.');
        }
    }
}
