<?php

use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware([])
    ->group(function (Router $router) {
        $router->get('/', fn() => view('dashboard'))
            ->name('dashboard');

        $router->get('/responsive-images-generator', fn() => view('responsiveimages'))
            ->name('responsive-images');
    });

Route::middleware(['auth:sanctum', 'verified'])
    ->get('/auth', function () {
        return view('dashboard');
    });
