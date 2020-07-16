<?php

namespace App\Http\Controllers;

use App\Models\Cruds;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;

class CrudGeneratorController extends Controller
{

    public function index()
    {
        $data = file_get_contents(storage_path("json/crud.json"));
        $data = collect(json_decode($data));
        return $data;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (isset($request->empty) && $request->empty) {
            file_put_contents(storage_path("json/crud.json"), "[]");
            return responseJson('success');
        }
        file_put_contents(storage_path("json/crud.json"), json_encode($request->cruds));
        if (isset($request->data) && $request->data) {
            $this->handleRequest($request->data);
        }
        return responseJson('success');
    }

    /**
     * @param $request
     */
    private function handleRequest($data)
    {
        $generate = $data['generate'];
        $fields = $data['fields'];
        $className = $data['class_name'];
        $classPlural = $data['class_name'];
        $classSingular = Str::lower($data['class_name']);
        $classSnake = Str::snake($data['class_name']);
//        $rootNamespace = Str::snake($request->root_namespace);
        $rootNamespace = 'App';
        $namespace = 'App\Http\Controllers';

        $tableName = $data['table_name'];
        $relationships = $data['relationships'];

        $data_crud = compact('className', 'classPlural', 'classSingular', 'classSnake', 'tableName', 'fields', 'relationships', 'rootNamespace', 'namespace');

        $this->makeMigration($data_crud);

        if ($generate['model']) {
            $this->makeModel($data_crud);
        }

        if ($generate['controller']) {
            $this->makeController($data_crud);
            $this->makeActionView($data_crud);
//            $this->makeApiResource($data_crud);
        }

        if ($generate['vue']){
            $this->makeVue($data_crud);
        }

        if ($generate["router"]) {
//            file_put_contents(resource_path("/js/screens/{$data['classSnake']}/{$data['className']}Index.vue"), $resTemplate);
            $route = "\n " . "Route::apiResource('" . strtolower($className) . "', '" . $className . "Controller');";
            File::append(base_path("routes/api.php"), $route);

            $import = "import {$data_crud['className']} from './screens/{$data_crud['classSnake']}/{$data_crud['className']}Index.vue'"."\n ";
            $importClass = "{
                path: '/mainapp/".strtolower($data_crud['className'])."',
                name: '".$data_crud['className']."',
                component: ".$data_crud['className'].",
                meta: {
                    requiresAuth: true,
                    role: 'admin|super-admin'
                }
            }";
            File::prepend(base_path("resources/js/router.js"), $importClass);
            File::prepend(base_path("resources/js/router.js"), $import);

        }

        if ($data['migrate_immediately']) {
            if ($data['migrate_fresh']) {
                Artisan::call('migrate:fresh --seed');
            } else {
                Artisan::call('migrate');
            }
        }
        Artisan::call('ide-helper:models --write');
    }


    /**
     * Make API Resource
     * @param $data
     */
    private function makeApiResource($data)
    {
        $fields = $data['fields'];
        $relationships = $data['relationships'];
        $arr = [];
        $primaryKey = "";
        foreach ($fields as $field) {
            if ($field['primary']) {
                $primaryKey = $field['name'];
            }
            $arr[] = '"' . $field['name'] . '"' . '=>' . ' $this->' . $field['name'] . ',';
//            $db->name = $request->name;
        }

        foreach ($relationships as $relationship) {
            $arr[] = '"' . $relationship . '"' . '=>' . ' $this->' . $relationship . ',';
        }
        $dataJson = implode("\n", $arr);

        $stubTemplate = [
            '{{ className }}',
            '{{ classNamePlural }}',
            '{{ classNameSingular }}',
            '{{ classNameSnake }}',
            '{{ dataJson }}',
            '{{ primaryKey }}'
        ];
        $stubReplaceTemplate = [
            $data['className'], $data['classPlural'], $data['classSingular'], $data['classSnake'], $dataJson, $primaryKey
        ];
        $resTemplate = str_replace($stubTemplate, $stubReplaceTemplate, $this->getStub('resource'));

        file_put_contents(app_path("/Http/Resources/{$data['className']}Resource.php"), $resTemplate);
    }

    /**
     * make Controller stub
     */
    private function makeController($data)
    {
        $fields = $data['fields'];
        $handleRequest = View::make('stub_helpers.handle_request', compact('fields'))->render();
        $makeValidation = View::make('stub_helpers.make_validation', compact('fields'))->render();
        $stubTemplate = [
            '{{ validasi }}',
            '{{ className }}',
            '{{ classNamePlural }}',
            '{{ classNameSingular }}',
            '{{ classNameSnake }}',
            '{{ handleRequest }}',
        ];
        $stubReplaceTemplate = [
            $makeValidation,
            $data['className'],
            $data['classPlural'],
            $data['classSingular'],
            $data['classSnake'],
            $handleRequest,
        ];
        $controllerTemplate = str_replace($stubTemplate, $stubReplaceTemplate, $this->getStub('controller'));

        file_put_contents(app_path("/Http/Controllers/{$data['className']}Controller.php"), $controllerTemplate);
    }

    /**
     * make model
     * @param $data
     */
    private function makeModel($data)
    {
        $fields = $data['fields'];
        $relationships = $data['relationships'];
        $tableName = $data['tableName'];
        $arr = [];
        $primaryKey = "";
        foreach ($fields as $field) {
            if ($field['primary']) {
                $primaryKey = $field['name'];
            }
        }

        foreach ($relationships as $relationship) {
            $arr[] = 'public function ' . $relationship . '(){}';
        }
        $functions = implode("\n", $arr);

        $stubTemplate = [
            '{{ className }}',
            '{{ classNamePlural }}',
            '{{ classNameSingular }}',
            '{{ functions }}',
            '{{ primaryKey }}',
            '{{ tableName }}',
        ];
        $stubReplaceTemplate = [
            $data['className'], $data['classPlural'], $data['classSingular'], $functions, $primaryKey, $tableName
        ];
        $resTemplate = str_replace($stubTemplate, $stubReplaceTemplate, $this->getStub('model'));

        file_put_contents(app_path("/Models/{$data['classPlural']}.php"), $resTemplate);
    }

    /**
     * make vue
     * @param $data
     */
    private function makeVue($data)
    {
        $fields = $data['fields'];
        $columnsArr = [];
        foreach ($fields as $field) {
            if ($field['primary'] == false) {
                $columnsArr[] = '{ name:"'.$field['name'].'", print:true, title: "' . ucwords($field['text']) . '", data: "' . $field['name'] . '", class: "auto" },';
            }
        }

        $hasil = View::make('stub_helpers.form_group', compact('fields'))->render();
        $columnsArr[] = '{ title: "Action", data: "action", class: "text-center w-25 all" }';
        $columns = implode("\n", $columnsArr);

        $jsonArr = [];
        foreach ($fields as $field) {
            $jsonArr[] = $field['name'] . ':"",';
        }
        $jsonData = implode("\n", $jsonArr);

        $stubTemplate = [
            '{{ className }}',
            '{{ classNamePlural }}',
            '{{ classNameSingular }}',
            '{{ columns }}',
            '{{ jsonData }}',
            '{{ formGroup }}'
        ];
        $stubReplaceTemplate = [
            $data['className'], $data['classPlural'], $data['classSingular'], $columns, $jsonData, $hasil];
        $resTemplate = str_replace($stubTemplate, $stubReplaceTemplate, $this->getStub('vue'));
        $path = '/js/screens/' . $data['classSnake'];
        if (!is_dir(resource_path($path))) {
            mkdir(resource_path($path));
        }

        file_put_contents(resource_path("/js/screens/{$data['classSnake']}/{$data['className']}Index.vue"), $resTemplate);
    }

    /**
     * make migrations
     * @param $data
     */
    private function makeMigration($data)
    {
        $fields = $data['fields'];

        $hasil = View::make('stub_helpers.migration', compact('fields'))->render();
        $stubTemplate = [
            '{{ className }}',
            '{{ classNamePlural }}',
            '{{ classNameSingular }}',
            '{{ tableName }}',
            '{{ dataMigrate }}'
        ];
        $stubReplaceTemplate = [
            $data['className'],
            $data['classPlural'],
            $data['classSingular'],
            $data['tableName'],
            $hasil
        ];
        $resTemplate = str_replace($stubTemplate, $stubReplaceTemplate, $this->getStub('migration'));
        $datePrefix = 'my_crud_migration_file';
        $path = database_path("migrations/{$datePrefix}_create_{$data['classSnake']}_table.php");
        file_put_contents($path, $resTemplate);
    }

    /**
     * make action view
     * @param $data
     */
    private function makeActionView($data)
    {
        $fields = $data['fields'];
        $primaryKey = "";
        foreach ($fields as $field) {
            if ($field['primary']) {
                $primaryKey = $field['name'];
            }
            $arr[] = '"' . $field['name'] . '"' . '=>' . ' $this->' . $field['name'] . ',';
//            $db->name = $request->name;
        }
        $stubTemplate = [
            '{{ id }}',
            '{{ classNameSingular }}',
        ];
        $stubReplaceTemplate = [
            $primaryKey,
            $data['classSingular'],
        ];
        $resTemplate = str_replace($stubTemplate, $stubReplaceTemplate, $this->getStub('action'));
        $path = resource_path("views/actions/{$data['classSnake']}.blade.php");
        file_put_contents($path, $resTemplate);
    }

    /**
     * @param $type
     * @return bool|string
     */
    private function getStub($type)
    {
        if ($type == 'vue') {
            return file_get_contents(base_path("stubs/crud_vue.stub"));
        } else if ($type == 'js') {
            return file_get_contents(base_path("stubs/crud_js.stub"));
        } else if ($type == 'controller') {
            return file_get_contents(base_path("stubs/my_api_controller.stub"));
        } else if ($type == 'resource') {
            return file_get_contents(base_path("stubs/my_api_resources.stub"));
        } else if ($type == 'model') {
            return file_get_contents(base_path("stubs/my_model_resources.stub"));
        } else if ($type == 'migration') {
            return file_get_contents(base_path("stubs/my_migration.stub"));
        } else if ($type == 'action') {
            return file_get_contents(base_path("stubs/my_action.stub"));
        }
    }
}
