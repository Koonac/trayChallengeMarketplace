<?php

use App\Http\Controllers\ImportarAnunciosController;
use Illuminate\Support\Facades\Route;

Route::post('/importarAnuncios', [ImportarAnunciosController::class, 'importarAnuncios']);
