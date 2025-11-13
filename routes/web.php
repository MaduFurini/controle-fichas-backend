<?php

use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/api/docs', function () {
    return view('documentation/apiDoc');
});

Route::get('/api/docs/json', function () {
    $path = base_path('storage/documentation/apiDoc.json');

    if (!file_exists($path)) {
        return response()->json(['message' => 'Documento não encontrado'], 404);
    }

    return Response::file($path, [
        'Content-Type' => 'application/json',
    ]);
});
