<?php

use App\Http\Controllers\ApiController;
use Illuminate\Support\Facades\Route;

Route::get('/impressoras', [ApiController::class, 'impressoras']);
Route::get('/leituras',    [ApiController::class, 'leituras']);
Route::post('/leitura',    [ApiController::class, 'storeLeitura']);
