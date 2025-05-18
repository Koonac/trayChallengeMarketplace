<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/* MARKETPLACES */
Route::prefix('mocketplace')->group(function (){
    Route::get('/importarAnuncios', function (Request $request) {
        return ['status' => 'success'];
    });
});
