<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;

class MakeActionCommand extends Command
{
    // Firma del comando artisan
    protected $signature = 'make:action {name : tha name or path of te action class}';

    // descripcion del comando
    protected $description = 'Create a new action class in the App/Actions directory using a predefined stub';

    // sistema de archivos de laravel propio
    protected Filesystem $files;

    public function __construct(Filesystem $files)
    {
        parent::__construct();
        // inyectar el filesistems para usrlo en toda la clase
        $this->files = $files;
    }

    // metodo que se correra desde la consola
    public function handle()
    {
        // obtener y formatear el nombre para crear el namespace de php
        $name = str_replace('/', '\\', $this->argument('name'));
        // separar namespace y nombre de la clase
        $classNameConNamespace = $this->getNamespace($name);
        $className = $this->getClassName($name);

        // leer el archivo stub
        $stub = $this->files->get(resource_path('stubs/action.stub')); // Load stub from resources/stubs

        // remplazar en el stub
        $stub = str_replace(
            ['{{ namespace }}', '{{ className }}'],
            [$classNameConNamespace, $className],
            $stub
        );

        // ruta final del archivo
        $path = app_path("Actions/{$classNameConNamespace}/{$className}.php");

        // crear carpeta si no existe
        $this->makeDirectory($path);

        // guardar el archivo generado
        $this->files->put($path, $stub);

        // mensaje de exito
        $this->info("Action {$className} created successfully at {$path}");
    }

    // obtener namespace 
    protected function getNamespace($name)
    {
        // si pasastes Users/CreateUserAction, esto devuelve Users
        $parts = explode('\\', $name);
        array_pop($parts);

        return count($parts) > 0 ? implode('\\', $parts) : '';
    }

    // devuelve el nombre de la clase ejemplo CreateUserAction
    protected function getClassName($name)
    {
        return class_basename($name);
    }

    // asegurar que el directoro existe o no
    protected function makeDirectory($path)
    {
        $directory = dirname($path);

        if (!$this->files->exists($directory)) {
            $this->files->makeDirectory($directory, 0755, true);
        }
    }
}
