<?php

use Illuminate\Support\Facades\Route;

/* Подключаем роуты модулей */
$modules = config('modules.modules');
$path = config('modules.path');
$baseNamespace = config('modules.base_namespace');

if ($modules) {
    foreach ($modules as $module) {
        $relativePath = '/' . $module;
        $routesPath = $path . $relativePath . '/Routes/web.php';
        if (file_exists($routesPath)) {
            Route::namespace("App\\Modules\\$module\\Controllers")->group($routesPath);
        }
    }
}

Route::get('/', function () {
    return view('welcome');
});
