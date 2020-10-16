<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::apiResource('gorevler','API\GorevController');
Route::post('/gorevler/tumunuKaldir','API\GorevController@tumunuKaldir');
