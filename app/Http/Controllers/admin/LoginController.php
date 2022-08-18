<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Auth;
class LoginController extends Controller
{
    public function getLogin() {
        return view('admin.auth.adminlogin');
    }
    public function Login(Request $request){

        //if he click remeber me make it true
        $remember_me = $request->has('remember_me') ? true : false;

        if (auth()->guard('admin')->attempt(['email' => $request->input("email"), 'password' => $request->input("password")])) {
            // notify()->success('تم الدخول بنجاح  ');


            return redirect() -> route('admin.dashboard');
        }else {
            // notify()->error('خطا في البيانات  برجاء المجاولة مجدا ');


            return redirect()->back()->with(['error' => 'هناك خطا بالبيانات']);
        }
    }

    public function logout(Request $request) {
        Auth::logout();
        return redirect('/login');
      }
}
