<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::apiResource('gorevler','API\GorevAPI');
Route::post('/gorevler/tumunuKaldir','API\GorevAPI@tumunuKaldir');

Route::apiResource('excel','API\ExcelAPI');
