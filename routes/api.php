<?php

use App\Http\Controllers\OrganizerController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\UserController;
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

Route::get('/get-sliders', [SliderController::class, 'getSliders']);
Route::post('/login', [UserController::class, 'login']);
Route::post('/sign-up', [UserController::class, 'register']);

Route::group(['prefix' => 'auth', 'middleware' => 'auth:sanctum'], function () {
    Route::get('/logout', [UserController::class, 'logout']);
});

Route::group(['prefix' => 'organizer'], function () {

    Route::post('/login', [OrganizerController::class, 'login']);
    // for help, not the producation
    Route::post('/create-organizer', [OrganizerController::class, 'createOrganizer']);
    
    
    Route::group(['prefix' => 'auth', 'middleware' => 'auth:organizers'], function () {
        Route::get('/organizer-info', [OrganizerController::class, 'getOrganizer']);
        Route::post('/create-organizer', [OrganizerController::class, 'createOrganizer']);

        Route::post('/create-slider', [SliderController::class, 'createSlider']);
        Route::post('/update-slider/{slider_id}', [SliderController::class, 'updateSlider']);
        Route::delete('/delete-slider/{slider_id}', [SliderController::class, 'deleteSlider']);

        Route::get('/logout', [OrganizerController::class, 'logout']);
    });
});
