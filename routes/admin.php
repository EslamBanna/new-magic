<?php

use App\Http\Controllers\admin\ConsultantPackageController;
use App\Http\Controllers\admin\LoginController;
use App\Http\Controllers\admin\OrganizerController;
use App\Http\Controllers\admin\SliderController;
use App\Http\Controllers\admin\SupportController;
use App\Http\Controllers\admin\UsersController;
use App\Http\Controllers\FeedbackController;
use Illuminate\Support\Facades\Route;
use App\Models\ChatMessage;
use App\Models\User;
use App\Models\CunsultantPackage;
use App\Models\consultantTest;
use App\Models\CunsultantPackages;
use App\Models\CunsultantTests;
Route::get('/test', function () {
    return 'admin';
});
Route::group(['middleware' => 'auth:admin'], function () {
    // Route::get('/test', function () {
    //     return 'admin';
    // });
    Route::get('admin/dashboard', function () {
        $counter = [];
        // $chatMessages = ChatMessage::all();
        $users = User::all();
        $ConsultantPackages = CunsultantPackages::all();
        $consultantTest = CunsultantTests::all();
        $counter[0] = $users;
        // $counter[1] = $chatMessages;
        $counter[2] = $ConsultantPackages;
        $counter[3] = $consultantTest;
        return view('admin.dashboard', compact('counter'));
    })->name('admin.dashboard');
    Route::get('admin/profile', function () {
        return view('admin.profile');
    });
    Route::resource("admin/slider", SliderController::class);
    Route::resource("admin/organizers", OrganizerController::class);

    Route::resource("admin/support", SupportController::class);
    Route::resource("admin/users", UsersController::class);
    Route::resource("admin/consultant-packages", ConsultantPackageController::class);

    Route::get("admin/consultant-tests", [ConsultantPackageController::class, 'getalltests'])->name('all-consult-tests');

    Route::get('logout', '\App\Http\Controllers\admin\LoginController@logout');

    /********************************** Messages  **********************/

    Route::get('admin/messages', ['as' => 'admin-messages', 'uses' => 'MessagesController@index']);
    Route::post('/insert/chat/', ['as' => 'admin-chat2', 'uses' => 'MessagesController@insertChat']);
    Route::post('/fetch/history/', ['as' => 'admin-fetch-user-history2', 'uses' => 'MessagesController@FetchUserHistory']);
    /************************************* end messages ********************/

    //send email to support admin
    Route::post('admin/support', [SupportController::class,'contactemail'])->name('admin.contact.submit');


    // feedback

    Route::get('admin/feedback', [FeedbackController::class,'adminGetFeedbacks'])->name('admin.feedback');
    Route::delete('delete/feedback/{id}', [FeedbackController::class,'deleteFeedback'])->name('delete.feedback');
    /************************************* end messages ********************/

    // ######################################

});

// get result of user exam

Route::post('admin/face-exam-result/{id}', 'user\FaceTestController@show')->name('admin.faceResult');

Route::post('admin/body-exam-result/{id}', 'user\BodyTestController@show')->name('admin.bodyResult');

Route::post('admin/style-exam-result/{id}', 'user\StyleTestController@show')->name('admin.styleResult');

Route::group(['middleware' => 'guest:admin'], function () {

    Route::get('login', [LoginController::class, 'getLogin'])->name('get.admin.login');
    Route::post('login', [LoginController::class, 'login'])->name('admin.login');
});


