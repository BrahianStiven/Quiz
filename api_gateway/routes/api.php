<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LabelsController;
use App\Http\Controllers\GenresController;
use App\Http\Controllers\BandsController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('/generate_labels', [LabelsController::class, 'generateLabels']);
Route::get('/record_labels', [LabelsController::class, 'recordLabels']);
Route::get('/genres', [GenresController::class, 'getGenres']);
Route::get('/genres/{id}', [GenresController::class, 'getGenre']);
Route::get('/bands', [BandsController::class, 'getBands']);
Route::get('/bands/{id}', [BandsController::class, 'getBand']);
