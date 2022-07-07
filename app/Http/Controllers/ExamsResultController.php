<?php

namespace App\Http\Controllers;

use App\Models\ExamsResult;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ExamsResultController extends Controller
{
    use GeneralTrait;
    public function faceTest(Request $request)
    {
        try {
            $validate = Validator($request->all(), [
                "fore_head" => "required",
                "cheek" => "required",
                "face_length" => "required",
                "jaw" => "required",
                "chin_shape" => "required",
                "salience_radio" => "required",
            ]);
            if ($validate->fails()) {
                return $this->returnError(202, $validate->errors()->first());
            }
            $face_shape = "";
            if ($request->cheek > $request->fore_head && $request->cheek > $request->jaw) {
                $face_shape = "Oval";
            } elseif ($request->cheek == $request->fore_head && $request->cheek == $request->jaw && $request->salience_radio == "yes") {
                $face_shape = "Square";
            } elseif ($request->jaw < $request->fore_head && $request->cheek == $request->fore_head && $request->chin_shape == "tapered") {
                $face_shape = "Inverted Triangle";
            } elseif ($request->cheek == $request->face_length && $request->salience_radio == "no") {
                $face_shape = "Ring";
            } elseif ($request->cheek > $request->fore_head && $request->cheek > $request->jaw && $request->chin_shape == "tapered") {
                $face_shape = "Appointed";
            } elseif ($request->jaw > $request->fore_head) {
                $face_shape = "Triangle";
            } else {
                $face_shape = "Inverted Triangle";
            }
            // because first_exam column with json datatype
            $exam = array(
                'fore_head' => $request->fore_head,
                "cheek" => $request->cheek,
                "face_length" => $request->face_length,
                "jaw" => $request->jaw,
                "chin_shape" => $request->chin_shape,
                "salience_radio" => $request->salience_radio,
                "face_shape" => $face_shape, //thats the result
            );

            //find if user exams results was exists or not
            $user_exam = ExamsResult::where('user_id', '=', Auth()->user()->id)->get();

            // if count of user greater than 0 , it means that he has rows befor show so he tested befor , then we just should edit exam result
            if (count($user_exam) != 0) {
                $user_exam = ExamsResult::find($user_exam[0]->id);
                $user_exam->update([
                    "first_exam" => json_encode($exam),
                ]);
            } else {
                // it means that it's the first test for the user
                $user_exam = ExamsResult::create([
                    "first_exam" => json_encode($exam),
                    "user_id" => Auth()->user()->id
                ]);
            }
            return $this->returnData('data', $face_shape);
        } catch (\Exception $e) {
            return $this->returnError(202, $e->getMessage());
        }
    }
}
