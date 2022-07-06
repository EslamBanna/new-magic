<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    use GeneralTrait;
    public function makeFeedback(Request $request){
        try{
            $validate = validator($request->all(), [
                'rate' => 'required|integer',
                'comment' => 'nullable',
            ]);
            if($validate->fails()){
                return $this->returnError(202, $validate->errors()->first());
            }
            Feedback::create([
                'user_id' => Auth()->user()->id,
                'rate' => $request->rate,
                'comment' => $request->comment,
            ]);
            return $this->returnSuccessMessage('success');
        }catch(\Exception $e){
            return $this->returnError(201,$e->getMessage());
        }
    }

    public function getFeedbacks(){
        try{
            $feedbacks = Feedback::with('user:id,name,email')->get();
            return $this->returnData('data',$feedbacks);
        }catch(\Exception $e){
            return $this->returnError(201,$e->getMessage());
        }
    }

    public function deleteFeedback($id){
        try{
            $feedback = Feedback::find($id);
            if(!$feedback){
                return $this->returnError(202,'Feedback not found');
            }
            $feedback->delete();
            return $this->returnSuccessMessage('success');
        }catch(\Exception $e){
            return $this->returnError(201,$e->getMessage());
        }
    }
}
