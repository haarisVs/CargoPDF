<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ConsignmentController;
use App\Http\Middleware\ValidateEncryptedCredentials;

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

Route::middleware([ValidateEncryptedCredentials::class])->group(function () {
    Route::post('consignments', [ConsignmentController::class, 'store']);
});

Route::get('download-pdf/{filename}', [ConsignmentController::class, 'download']);
