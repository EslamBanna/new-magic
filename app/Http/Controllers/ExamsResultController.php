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

    public function bodyTest(Request $request)
    {
        try {
            //validation
            $nulls = 0;
            $max = 0;
            $max_choices = [];
            $result = '';
            //getting max value
            foreach ($request->request as $key => $value) {
                if ($key == '_token') {
                    continue;
                }
                if (!isset($value)) {
                    $nulls++;
                }
                if ($key == 'Shoulder' || $key == 'Chest' || $key == 'waist' || $key == 'lchest' || $key == 'Buttock' || $key == 'cthighs') {
                    if ((int)$value > $max) {
                        $max = (int)$value;
                        $max_choices[0] = $key;
                    }
                }
            }
            //getting equal for max value
            foreach ($request->request as $key => $value) {
                if ((int)$value === $max) {
                    if (!in_array($key, $max_choices)) {
                        $max_choices[] = $key;
                    }
                }
            }
            //to ensure that he entered all the sizes 
            if (count($request->request) < 27) {
                return $this->returnError(202, 'Please enter all the sizes  of your body');
            }

            //determine body type
            if (count($max_choices) == 1) {
                if ($max_choices[0] == 'Shoulder') {
                    if ($request->Shoulder - $request->Buttock > 5) {
                        $result = 'Inverted_Triangle';
                    } else {
                        if ($request->Themiddle == "Unspecific") {
                            $result = 'Rectangle';
                        } elseif ($request->Themiddle == "Specific") {
                            $result = 'clock';
                        } else {
                            $result = 'Inverted_Triangle';
                        }
                    }
                } elseif ($max_choices[0] == 'Chest') {
                    $result = 'Strawberry';
                } elseif ($max_choices[0] == 'cthighs') {
                    $result = 'Triangle';
                } elseif ($max_choices[0] == 'Buttock') {
                    $result = 'Pear';
                } else {
                    $result = 'Diamond';
                }
            } elseif (count($max_choices) == 2) {
                //then its apple or diamond or maybe rectangle or clock
                if (in_array('center', $max_choices) && in_array('waist', $max_choices)) {
                    $result = 'Apple';
                } elseif (in_array('Shoulder', $max_choices) && in_array('Buttock', $max_choices) && $request->Themiddle == "Unspecific") {
                    $result = 'Rectangle';
                } elseif (in_array('Shoulder', $max_choices) && in_array('Buttock', $max_choices) && $request->Themiddle == "Specific") {
                    $result = 'clock';
                } else {
                    $result = 'Inverted_Triangle';
                }
            } elseif (count($max_choices) > 2) {
                //then it's diamond type

                // if(in_array('center',$max_choices)&&in_array('waist',$max_choices)&&in_array('Chest',$max_choices)&&in_array('Buttock',$max_choices)){$result='Diamond';}
                $result = 'Diamond';
            }


            //because second_exam column with json datatype
            $exam = array(
                "body" => $result,
                "user choices" => $request->all()
            );


            // //find if user exams results was exists or not
            $user_exam = ExamsResult::where('user_id', '=', Auth()->user()->id)->get();

            // if count of user greater than 0 , it means that he has rows befor show so he tested befor , then we just should edit exam result
            if (count($user_exam) != 0) {
                $user_exam = ExamsResult::find($user_exam[0]->id);
                $user_exam->update([
                    "second_exam" => json_encode($exam),
                ]);
            } else {
                // it means that it's the first test for the user
                $user_exam = ExamsResult::create([
                    "second_exam" => json_encode($exam),
                    "user_id" => Auth()->user()->id
                ]);
            }

            return $this->returnData('data', $result);
        } catch (\Exception $e) {
            return $this->returnError(202, $e->getMessage());
        }
    }
}
