<?php

namespace App\Http\Controllers;

use App\Models\CunsultantTests;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;

class CunsultantTestsController extends Controller
{
    use GeneralTrait;
    public function createCunsultantTest(Request $request){
        try{
            $validate = validator($request->all(), [
                'name' => 'required',
                'email' => 'required',
                'consult_id' => 'required|exists:cunsultant_packages,id',
                'age' => 'required',
                'phone' => 'required',
                'job' => 'required',
                'social_status' => 'required',
                'apperance' => 'required',
                'feel' => 'required',
                'interest' => 'required',
                'budget' => 'required',
                'amount' => 'required',
                'brand' => 'required',
                'formats' => 'required',
                'want' => 'required'
            ]);
            if($validate->fails()){
                return $this->returnError(202, $validate->errors()->first());
            }
            CunsultantTests::create([
                'name' => $request->name,
                'email' => $request->email,
                'consult_id' => $request->consult_id,
                'user_id' => Auth()->user()->id,
                'age' => $request->age,
                'phone' => $request->phone,
                'job' => $request->job,
                'social_status' => $request->social_status,
                'apperance' => $request->apperance,
                'feel' => $request->feel,
                'interest' => $request->interest,
                'budget' => $request->budget,
                'amount' => $request->amount,
                'brand' => $request->brand,
                'formats' => $request->formats,
                'want' => $request->want
            ]);
            return $this->returnSuccessMessage('success');
        }catch(\Exception $e){
            return $this->returnError(201, $e->getMessage());
        }
    }

    public function getCunsultantTests(){
        try{
            $cunsultantTests = CunsultantTests::all();
            return $this->returnData('data', $cunsultantTests);
        }
        catch(\Exception $e){
            return $this->returnError(201, $e->getMessage());
        }
    }
    public function deleteCunsultantTest($id){
        try{
            $cunsultantTest = CunsultantTests::find($id);
            if(!$cunsultantTest){
                return $this->returnError(201, 'this cunsultant test is not existed');
            }
            $cunsultantTest->delete();
            return $this->returnSuccessMessage('success');
        }catch(\Exception $e){
            return $this->returnError(201, $e->getMessage());
        }
    }
}
