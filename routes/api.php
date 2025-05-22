<?php

use App\Http\Controllers\ImportOffersController;
use Illuminate\Support\Facades\Route;

Route::post('/importar-anuncios', ImportOffersController::class);
