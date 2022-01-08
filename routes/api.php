<?php
use App\Http\Controllers\PatientController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('patients', PatientController::class);
Route::get('/patients/status/positive', [PatientController::class, 'positive']);
Route::get('/patients/status/recovered', [PatientController::class, 'recovered']);
Route::get('/patients/status/dead', [PatientController::class, 'dead']);
Route::get('/patients/search/{name}', [PatientController::class, 'search']);