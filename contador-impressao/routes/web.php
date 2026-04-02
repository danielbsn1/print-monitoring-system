<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ImpressoraController;




Route::get('/', [ImpressoraController::class, 'index']);
