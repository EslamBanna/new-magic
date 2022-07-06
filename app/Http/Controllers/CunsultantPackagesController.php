<?php

namespace App\Http\Controllers;

use App\Models\CunsultantPackages;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;

class CunsultantPackagesController extends Controller
{
    use GeneralTrait;
    public function createCunsultantPackage(Request $request)
    {
        try {
            $validate = validator($request->all(), [
                'description_en' => 'required',
                'description_ar' => 'required',
                'price' => 'required',
                'consultation_type_en' => 'required',
                'consultation_type_ar' => 'required',
            ]);
            if ($validate->fails()) {
                return $this->returnError(202, $validate->errors()->first());
            }
            CunsultantPackages::create([
                'description_en' => $request->description_en,
                'description_ar' => $request->description_ar,
                'price' => $request->price,
                'consultation_type_en' => $request->consultation_type_en,
                'consultation_type_ar' => $request->consultation_type_ar,
            ]);
            return $this->returnSuccessMessage('success');
        } catch (\Exception $e) {
            return $this->returnError(201, $e->getMessage());
        }
    }

    public function updateCunsultantPackage($id, Request $request)
    {
        try {
            $validate = validator($request->all(), [
                'description_en' => 'required',
                'description_ar' => 'required',
                'price' => 'required',
                'consultation_type_en' => 'required',
                'consultation_type_ar' => 'required',
            ]);
            if ($validate->fails()) {
                return $this->returnError(202, $validate->errors()->first());
            }
            $cunsultantPackage = CunsultantPackages::find($id);
            if (!$cunsultantPackage) {
                return $this->returnError(201, 'this cunsultant package is not found');
            }
            $cunsultantPackage->update([
                'description_en' => $request->description_en ?? $cunsultantPackage->description_en,
                'description_ar' => $request->description_ar ?? $cunsultantPackage->description_ar,
                'price' => $request->price ?? $cunsultantPackage->price,
                'consultation_type_en' => $request->consultation_type_en ?? $cunsultantPackage->consultation_type_en,
                'consultation_type_ar' => $request->consultation_type_ar ?? $cunsultantPackage->consultation_type_ar
            ]);
            return $this->returnSuccessMessage('success');
        } catch (\Exception $e) {
            return $this->returnError(201, $e->getMessage());
        }
    }

    public function deleteCunsultantPackage($id)
    {
        try {
            $cunsultantPackage = CunsultantPackages::find($id);
            if (!$cunsultantPackage) {
                return $this->returnError(201, 'this cunsultant package is not found');
            }
            $cunsultantPackage->delete();
            return $this->returnSuccessMessage('success');
        } catch (\Exception $e) {
            return $this->returnError(201, $e->getMessage());
        }
    }

    public function getCunsultantPackages()
    {
        try {
            $cunsultantPackages = CunsultantPackages::all();
            return $this->returnData('data', $cunsultantPackages);
        } catch (\Exception $e) {
            return $this->returnError(201, $e->getMessage());
        }
    }
}
