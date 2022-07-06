<?php

namespace App\Http\Controllers;

use App\Models\Organizer;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class OrganizerController extends Controller
{
    use GeneralTrait;
    public function login(Request $request)
    {
        $validate = validator($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ]);
        if ($validate->fails()) {
            return $this->returnError(202, $validate->errors()->first());
        }
        $user = Organizer::where('email', $request->email)->first();
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

    public function createOrganizer(Request $request)
    {
        try {
            $validate = validator($request->all(), [
                'email' => 'required|email',
                'name' => 'required',
                'phone' => 'required',
                'role' => 'required|in:admin,consultant',
                'password' => 'required'
            ]);
            if ($validate->fails()) {
                return $this->returnError(202, $validate->errors()->first());
            }
            $checkUser = Organizer::where('email', $request->email)
                ->orWhere('phone', $request->phone)
                ->first();
            if ($checkUser) {
                return $this->returnError(201, 'this account is existed already');
            }
            Organizer::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'phone' => $request->phone,
                'role' => $request->role,
                'consultant_category' => $request->consultant_category
            ]);
            return $this->returnSuccessMessage('success');
        } catch (\Exception $e) {
            return $this->returnError(201, $e->getMessage());
        }
    }

    public function getOrganizer()
    {
        try {
            return $this->returnData('data', Auth()->user());
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

    public function updateOrganizer(Request $request)
    {
        try {
            $validate = validator($request->all(), [
                'email' => 'required|email',
                'name' => 'required',
                'phone' => 'required',
                'role' => 'required|in:admin,consultant',
                'password' => 'required'
            ]);
            if ($validate->fails()) {
                return $this->returnError(202, $validate->errors()->first());
            }
            $checkUser = Organizer::where('email', $request->email)
                ->first();
            if ($checkUser && $checkUser->id != Auth()->user()->id) {
                return $this->returnError(201, 'this email is existed already');
            }
            $checkUser = Organizer::where('phone', $request->phone)
                ->first();
            if ($checkUser && $checkUser->id != Auth()->user()->id) {
                return $this->returnError(201, 'this phone is existed already');
            }
            $organizer = Organizer::find(Auth()->user()->id);
            $organizer->update([
                'name' => $request->name ?? $organizer->name,
                'email' => $request->email ?? $organizer->email,
                'password' => Hash::make($request->password) ?? $organizer->password,
                'phone' => $request->phone ?? $organizer->phone,
                'role' => $request->role ?? $organizer->role,
                'consultant_category' => $request->consultant_category ?? $organizer->consultant_category
            ]);
            return $this->returnSuccessMessage('success');
        } catch (\Exception $e) {
            return $this->returnError(201, $e->getMessage());
        }
    }
}
