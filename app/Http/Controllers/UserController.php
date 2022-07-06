<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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
}
