<?php

use App\Http\Controllers\CunsultantPackagesController;
use App\Http\Controllers\CunsultantTestsController;
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
Route::get('/get-cunsultant-packages', [CunsultantPackagesController::class, 'getCunsultantPackages']);
Route::post('/login', [UserController::class, 'login']);
Route::post('/sign-up', [UserController::class, 'register']);

Route::group(['prefix' => 'auth', 'middleware' => 'auth:users'], function () {
    Route::post('/update-user', [UserController::class, 'updateUser']);
    Route::get('/logout', [UserController::class, 'logout']);

    Route::post('/create-cunsultant-test', [CunsultantTestsController::class, 'createCunsultantTest']);
});

Route::group(['prefix' => 'organizer'], function () {

    Route::post('/login', [OrganizerController::class, 'login']);
    // for help, not the producation
    Route::post('/create-organizer', [OrganizerController::class, 'createOrganizer']);


    Route::group(['prefix' => 'auth', 'middleware' => 'auth:organizers'], function () {
        Route::get('/organizer-info', [OrganizerController::class, 'getOrganizer']);
        Route::post('/create-organizer', [OrganizerController::class, 'createOrganizer']);
        Route::post('/update-organizer', [OrganizerController::class, 'updateOrganizer']);

        Route::post('/create-slider', [SliderController::class, 'createSlider']);
        Route::post('/update-slider/{slider_id}', [SliderController::class, 'updateSlider']);
        Route::delete('/delete-slider/{slider_id}', [SliderController::class, 'deleteSlider']);

        Route::post('/create-cunsultant-package', [CunsultantPackagesController::class, 'createCunsultantPackage']);
        Route::put('/update-cunsultant-package/{id}', [CunsultantPackagesController::class, 'updateCunsultantPackage']);
        Route::delete('/delete-cunsultant-package/{id}', [CunsultantPackagesController::class, 'deleteCunsultantPackage']);

        Route::get('/get-cunsultant-tests', [CunsultantTestsController::class, 'getCunsultantTests']);
        Route::delete('/delete-cunsultant-test/{id}', [CunsultantTestsController::class, 'deleteCunsultantTest']);

        Route::get('/logout', [OrganizerController::class, 'logout']);
    });
});
