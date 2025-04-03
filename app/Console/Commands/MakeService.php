<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;

class MakeService extends Command
{
    protected $signature = 'make:service {name}';
    protected $description = 'Cria um novo service em app/Http/Services';

    public function handle()
    {
        $name = $this->argument('name');
        $path = app_path("Http/Services/{$name}.php");

        if (file_exists($path)) {
            $this->error('Esse service já existe!');
            return;
        }

        (new Filesystem)->ensureDirectoryExists(dirname($path));

        file_put_contents($path, "<?php\n\nnamespace App\Http\Services;\n\nclass {$name} \n{\n    // Implementação do service\n}");

        $this->info("Service {$name} criado com sucesso!");
    }
}
