<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class MakeCrudVue extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:crud {class}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Making Crud Vue JS';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $className = $this->argument('class');

        Artisan::call('make:controller ' . $className . 'Controller --api');
        Artisan::call('make:resource ' . $className . 'Resource');
        Artisan::call('make:model Models/' . $className);

        File::append(base_path("routes/api.php"), "\n " . "Route::resource('" . strtolower($className) . "', '" . $className . "Controller')->except(['create', 'edit']);");

        $this->component($className);
    }

    protected function getStub($type)
    {
        if($type == 'vue'){
            return file_get_contents(base_path("stubs/crud_vue.stub"));
        }else if($type == 'js'){
            return file_get_contents(base_path("stubs/crud_js.stub"));
        }
    }

    protected function component($className)
    {
        $vue = $this->getStub('vue');
        $js = $this->getStub('js');
        $path = Str::kebab($className);
        mkdir(resource_path('/js/screens/' . $path));
        file_put_contents(resource_path("/js/screens/{$path}/{$className}Index.vue"), $vue);
        file_put_contents(resource_path("/js/screens/{$path}/{$className}.js"), $js);
    }
}
