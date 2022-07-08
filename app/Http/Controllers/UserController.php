<?php

namespace App\Http\Controllers;

use App\Mail\VerficationMail;
use App\Models\User;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    use GeneralTrait;
    public function login(Request $request)
    {
        $validate = validator($request->all(), [
            'email' => 'required|email|exists:users,email',
            'password' => 'required'
        ]);
        if ($validate->fails()) {
            return $this->returnError(202, $validate->errors()->first());
        }
        $user = User::where('email', $request->email)->first();
        if (!$user || !Hash::check($request->password, $user->password)) {
            return $this->returnError(202, 'this user is not authenticated');
        }

        $token = $user->createToken('my-app-token')->plainTextToken;

        $data = [
            'user' => $user,
            'token' => $token
        ];
        return $this->returnData('data', $data);
    }

    public function register(Request $request)
    {
        try {
            $validate = validator($request->all(), [
                'email' => 'required|email',
                'name' => 'required',
                'password' => 'required'
            ]);
            if ($validate->fails()) {
                return $this->returnError(202, $validate->errors()->first());
            }
            $checkUser = User::where('email', $request->email)->first();
            if ($checkUser) {
                return $this->returnError(201, 'this account is existed already');
            }
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
            return $this->returnSuccessMessage('success');
        } catch (\Exception $e) {
            return $this->returnError(201, $e->getMessage());
        }
    }

    public function logout()
    {
        try {
            auth('sanctum')->user()->tokens()->delete();
            return $this->returnSuccessMessage('success');
        } catch (\Exception $e) {
            return $this->returnError(201, $e->getMessage());
        }
    }

    public function updateUser(Request $request)
    {
        try {
            $validate = validator($request->all(), [
                'name' => 'required',
                'email' => 'required|email',
                'password' => 'required'
            ]);
            if ($validate->fails()) {
                return $this->returnError(202, $validate->errors()->first());
            }
            $check_email_existsance = User::where('email', $request->email)->first();
            if ($check_email_existsance && $check_email_existsance->id != Auth::user()->id) {
                return $this->returnError(201, 'this email is existed already');
            }
            $user = User::find(Auth::user()->id);
            $user->update([
                'name' => $request->name ?? $user->name,
                'email' => $request->email ?? $user->email,
                'password' =>  Hash::make($request->password) ?? $user->password,
            ]);
            return $this->returnSuccessMessage('success');
        } catch (\Exception $e) {
            return $this->returnError(201, $e->getMessage());
        }
    }

    public function forgetPassword(Request $request)
    {
        try {
            $rules = [
                'email' => 'required|email'
            ];
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                $code = $this->returnCodeAccordingToInput($validator);
                return $this->returnValidationError($code, $validator);
            }
            $user = User::where('email', $request->email)->first();
            if (!$user) {
                return $this->returnError('202', 'user not founded');
            }
            $code =  rand(100000, 999999);
            $user->update([
                'reset_password_code' => $code
            ]);
            // send mail
            $reset_link = "http://reset-link/reset-password/" . $user->id;
            Mail::to($request->email)->send(new VerficationMail($code, $user->name, $user->email, $reset_link));
            return $this->returnSuccessMessage('success');
        } catch (\Exception $e) {
            return $this->returnError('201', $e->getMessage());
        }
    }

    public function getResetPasswordCode(Request $request)
    {
        try {
            if (!$request->has('user_id')) {
                return $this->returnError('202', 'please enter user id');
            }
            $user = User::find($request->user_id);
            if (!$user) {
                return $this->returnError('202', 'user not founded');
            }
            return $this->returnData('data', $user->reset_password_code);
        } catch (\Exception $e) {
            return $this->returnError('201', $e->getMessage());
        }
    }

    public function updatePassword(Request $request)
    {
        try {
            if (!$request->has('user_id') || !$request->has('password')) {
                return $this->returnError('202', 'you must enter user id and new password');
            }
            $user = User::find($request->user_id);
            if (!$user) {
                return $this->returnError('202', 'user not founded');
            }
            $user->update([
                'password' => bcrypt($request->password)
            ]);
            return $this->returnSuccessMessage('success');
        } catch (\Exception $e) {
            return $this->returnError('201', $e->getMessage());
        }
    }
}
