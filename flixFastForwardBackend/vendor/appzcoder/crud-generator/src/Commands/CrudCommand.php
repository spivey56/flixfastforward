<?php

namespace Appzcoder\CrudGenerator\Commands;

use File;
use Illuminate\Console\Command;

class CrudCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'crud:generate
                            {name : The name of the Crud.}
                            {--fields= : Fields name for the form & model.}
                            {--route=yes : Include Crud route to routes.php? yes|no.}
                            {--pk=id : The name of the primary key.}
                            {--view-path= : The name of the view path.}
                            {--namespace= : Namespace of the controller.}
                            {--route-group= : Prefix of the route group.}
                            {--localize=no : Localize the generated files? yes|no. }
                            {--locales=en : Locales to create lang files for.}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate Crud including controller, model, views & migrations.';

    /** @var string  */
    protected $routeName = '';

    /** @var string  */
    protected $controller = '';

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
        $name = $this->argument('name');
        $modelName = str_singular($name);
        $migrationName = str_plural(snake_case($name));
        $tableName = $migrationName;

        $routeGroup = $this->option('route-group');
        $this->routeName = ($routeGroup) ? $routeGroup . '/' . snake_case($name, '-') : snake_case($name, '-');

        $controllerNamespace = ($this->option('namespace')) ? $this->option('namespace') . '\\' : '';

        $fields = $this->option('fields');
        $primaryKey = $this->option('pk');
        $viewPath = $this->option('view-path');

        $fieldsArray = explode(',', $fields);
        $requiredFieldsStr = '';
        $fillableArray = [];

        foreach ($fieldsArray as $item) {
            $spareParts = explode('#', trim($item));
            $fillableArray[] = $spareParts[0];

            $currentField = trim($spareParts[0]);
            $requiredFieldsStr .= (isset($spareParts[2]))
            ? "'$currentField' => '{$spareParts[2]}', " : '';
        }

        $commaSeparetedString = implode("', '", $fillableArray);
        $fillable = "['" . $commaSeparetedString . "']";

        $requiredFields = ($requiredFieldsStr != '') ? "[" . $requiredFieldsStr . "]" : '';

        $localize = $this->option('localize');
        $locales = $this->option('locales');

        $this->call('crud:controller', ['name' => $controllerNamespace . $name . 'Controller', '--crud-name' => $name, '--model-name' => $modelName, '--view-path' => $viewPath, '--required-fields' => $requiredFields, '--route-group' => $routeGroup]);
        $this->call('crud:model', ['name' => $modelName, '--fillable' => $fillable, '--table' => $tableName, '--pk' => $primaryKey]);
        $this->call('crud:migration', ['name' => $migrationName, '--schema' => $fields, '--pk' => $primaryKey]);
        $this->call('crud:view', ['name' => $name, '--fields' => $fields, '--view-path' => $viewPath, '--route-group' => $routeGroup, '--localize' => $localize, '--pk' => $primaryKey]);
        if ($localize == 'yes') {
            $this->call('crud:lang', ['name' => $name, '--fields' => $fields, '--locales' => $locales]);
        }
        // For optimizing the class loader
        $this->callSilent('optimize');

        // Updating the Http/routes.php file
        $routeFile = app_path('Http/routes.php');
        if (file_exists($routeFile) && (strtolower($this->option('route')) === 'yes')) {
            $this->controller = ($controllerNamespace != '') ? $controllerNamespace . '\\' . $name . 'Controller' : $name . 'Controller';

            $isAdded = File::append($routeFile, "\n" . implode("\n", $this->addRoutes()));

            if ($isAdded) {
                $this->info('Crud/Resource route added to ' . $routeFile);
            } else {
                $this->info('Unable to add the route to ' . $routeFile);
            }
        }
    }

    /**
     * Add routes.
     *
     * @return  array
     */
    protected function addRoutes()
    {
        return ["Route::resource('" . $this->routeName . "', '" . $this->controller . "');"];
    }
}
