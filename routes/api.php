<?php

use App\Http\Controllers\CunsultantPackagesController;
use App\Http\Controllers\CunsultantTestsController;
use App\Http\Controllers\ExamsResultController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\MyFatoorahController;
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
Route::get('/get-feedbacks', [FeedbackController::class, 'getFeedbacks']);

Route::get('/error-pay', [MyFatoorahController::class, 'errorPay']);
Route::get('/success-pay', [MyFatoorahController::class, 'successPay']);

Route::post('/login', [UserController::class, 'login']);
Route::post('/sign-up', [UserController::class, 'register']);

Route::post('/forget-password', [UserController::class, 'forgetPassword']);
Route::post('/get-reset-password-code', [UserController::class, 'getResetPasswordCode']);
Route::post('/update-password', [UserController::class, 'updatePassword']);


Route::group(['prefix' => 'auth', 'middleware' => 'auth:users'], function () {
    Route::post('/update-user', [UserController::class, 'updateUser']);

    Route::post('/create-cunsultant-test', [CunsultantTestsController::class, 'createCunsultantTest']);

    Route::post('/make-feedback', [FeedbackController::class, 'makeFeedback']);

    Route::post("/face-test", [ExamsResultController::class, 'faceTest']);
    Route::post("/body-test", [ExamsResultController::class, 'bodyTest']);
    Route::post("/style-test", [ExamsResultController::class, 'styleTest']);

    Route::post('/pay', [MyFatoorahController::class, 'pay']);


    Route::get('/logout', [UserController::class, 'logout']);
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

        Route::delete('/delete-feedback/{id}', [FeedbackController::class, 'deleteFeedback']);

        Route::get('/logout', [OrganizerController::class, 'logout']);
    });
});
