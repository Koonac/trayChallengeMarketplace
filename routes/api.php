<?php

use App\Http\Controllers\importarAnunciosController;
use Illuminate\Support\Facades\Route;

Route::post('/importarAnuncios', [importarAnunciosController::class, 'importarAnuncios']);
