<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;

class MakeRepository extends Command
{
    protected $signature = 'make:repository {name}';
    protected $description = 'Cria um novo repository em app/Http/Repositories';

    public function handle()
    {
        $name = $this->argument('name');
        $path = app_path("Repositories/{$name}.php");

        if (file_exists($path)) {
            $this->error('Esse repository já existe!');
            return;
        }

        (new Filesystem)->ensureDirectoryExists(dirname($path));

        file_put_contents($path, "<?php\n\nnamespace App\Repositories;\n\nclass {$name} \n{\n    // Implementação do repository\n}");

        $this->info("Repository {$name} criado com sucesso!");
    }
}
