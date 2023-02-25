<?php

/* Подключаем views модулей */
$modules = config('modules.modules');
$path = config('modules.path');
$baseNamespace = config('modules.base_namespace');
$modulesViews = [];

if ($modules) {
    foreach ($modules as $module) {
        $relativePath = '/' . $module;
        $viewsPath = $path . $relativePath . '/Views';
        $modulesViews[] = $viewsPath;
    }
}

$paths = array_merge([resource_path('views')], $modulesViews);

return [

    /*
    |--------------------------------------------------------------------------
    | View Storage Paths
    |--------------------------------------------------------------------------
    |
    | Most templating systems load templates from disk. Here you may specify
    | an array of paths that should be checked for your views. Of course
    | the usual Laravel view path has already been registered for you.
    |
    */

    'paths' => $paths,

    /*
    |--------------------------------------------------------------------------
    | Compiled View Path
    |--------------------------------------------------------------------------
    |
    | This option determines where all the compiled Blade templates will be
    | stored for your application. Typically, this is within the storage
    | directory. However, as usual, you are free to change this value.
    |
    */

    'compiled' => env(
        'VIEW_COMPILED_PATH',
        realpath(storage_path('framework/views'))
    ),

];
