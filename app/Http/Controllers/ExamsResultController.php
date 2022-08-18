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
                    'note' => $request->note,
                ]);
            } else {
                // it means that it's the first test for the user
                $user_exam = ExamsResult::create([
                    "first_exam" => json_encode($exam),
                    "user_id" => Auth()->user()->id,
                    'note' => $request->note,
                ]);
            }
            $replace_space = str_replace(' ', '_', $face_shape);
            $result_image = asset('images/faces/' . $replace_space . '.png');
            $data = ['shape' => $face_shape, 'image' => $result_image];
            return $this->returnData('data', $data);
        } catch (\Exception $e) {
            return $this->returnError(202, $e->getMessage());
        }
    }

    public function bodyTest(Request $request)
    {
        try {
            $validate = Validator($request->all(), [
                "neck" => "required",
                "shoulder" => "required",
                "chest" => "required",
                "lower_chest" => "required",
                "center" => "required",
                "waist" => "required",
                "buttock" => "required",
                "circumference_of_the_thighs" => "required",
                "length_of_thighs" => "required",
                "leg_length" => "required",
                "trunk_length" => "required",
                "total" => "required",
                "physique" => "required|in:thin,medium,fat",
                "body_length" => "required|in:tall,medium,short",
                "neck_t" => "required|in:short_neck,medium_neck,tall_neck",
                "shoulders" => "required|in:proportion,small,wide",
                "shoulders_shape" => "required|in:curved,acute_angles",
                "repel" => "required|in:small,proportion,big",
                "the_middle" => "required|in:unspecific,specific,fat",
                "the_abdomen" => "required|in:flat,medium,fat",
                "trunk" => "required|in:down_middle,high_middle,proportional_middle",
                "buttocks" => "required|in:flat_buttocks,proportional_buttocks,notable_buttocks,big_buttocks",
                "the_thighs" => "required|in:thighs_proportion,medium_thighs,big_thighs",
                "leg" => "required|in:tall_leg,short_leg,proportional_leg",
                "leg_muscle" => "required|in:thin_muscle,medium_muscle,big_muscle",
            ]);
            if ($validate->fails()) {
                return $this->returnError(202, $validate->errors()->first());
            }
            // return $request;
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
                if ($key == 'shoulder' || $key == 'chest' || $key == 'waist' || $key == 'lower_chest' || $key == 'buttock' || $key == 'circumference_of_the_thighs') {
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
            if (count($request->request) < 26) {
                return $this->returnError(202, 'Please enter all the sizes  of your body');
            }

            //determine body type
            if (count($max_choices) == 1) {
                if ($max_choices[0] == 'shoulder') {
                    if ($request->shoulder - $request->buttock > 5) {
                        $result = 'Inverted_Triangle';
                    } else {
                        if ($request->the_middle == "unspecific") {
                            $result = 'Rectangle';
                        } elseif ($request->the_middle == "specific") {
                            $result = 'clock';
                        } else {
                            $result = 'Inverted_Triangle';
                        }
                    }
                } elseif ($max_choices[0] == 'chest') {
                    $result = 'Strawberry';
                } elseif ($max_choices[0] == 'circumference_of_the_thighs') {
                    $result = 'Triangle';
                } elseif ($max_choices[0] == 'buttock') {
                    $result = 'Pear';
                } else {
                    $result = 'Diamond';
                }
            } elseif (count($max_choices) == 2) {
                //then its apple or diamond or maybe rectangle or clock
                if (in_array('center', $max_choices) && in_array('waist', $max_choices)) {
                    $result = 'Apple';
                } elseif (in_array('shoulder', $max_choices) && in_array('buttock', $max_choices) && $request->the_middle == "unspecific") {
                    $result = 'Rectangle';
                } elseif (in_array('shoulder', $max_choices) && in_array('buttock', $max_choices) && $request->the_middle == "specific") {
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
                    'note' => $request->note,
                ]);
            } else {
                // it means that it's the first test for the user
                $user_exam = ExamsResult::create([
                    "second_exam" => json_encode($exam),
                    "user_id" => Auth()->user()->id,
                    'note' => $request->note,
                ]);
            }

            return $this->returnData('data', $result);
        } catch (\Exception $e) {
            return $this->returnError(202, $e->getMessage());
        }
    }

    public function styleTest(Request $request)
    {
        try {
            //validation
            $validate = Validator($request->all(), [
                "color" => "required|in:1,2,3,4,5,6,7",
                "makeup" => "required|in:1,2,3,4,5,6,7",
                "hair_style" => "required|in:1,2,3,4,5,6,7",
                "dress" => "required|in:1,2,3,4,5,6,7",
                "blouse" => "required|in:1,2,3,4,5,6,7",
                "pants" => "required|in:1,2,3,4,5,6,7",
                "skirt" => "required|in:1,2,3,4,5,6,7",
                "shoes" => "required|in:1,2,3,4,5,6,7",
                "bag" => "required|in:1,2,3,4,5,6,7",
                "jacket" => "required|in:1,2,3,4,5,6,7",
                "accessory" => "required|in:1,2,3,4,5,6,7",
                "appearance" => "required|in:1,2,3,4,5,6,7"
            ]);
            if ($validate->fails()) {
                return $this->returnError(202, $validate->errors()->first());
            }
            $romantic = 0;
            $classic = 0;
            $Casual = 0;
            $dramatic = 0;
            $Bohemian = 0;
            $Ancient = 0;
            $Gamine = 0;
            $user_choises = [];
            $style = [];
            $result = [];
            $style_comp = "";
            //
            $user_choises[] = $request->color;
            $user_choises[] = $request->makeup;
            $user_choises[] = $request->hair_style;
            $user_choises[] = $request->dress;
            $user_choises[] = $request->blouse;
            $user_choises[] = $request->pants;
            $user_choises[] = $request->skirt;
            $user_choises[] = $request->shoes;
            $user_choises[] = $request->bag;
            $user_choises[] = $request->jacket;
            $user_choises[] = $request->accessory;
            $user_choises[] = $request->appearance;
            // dd($user_choises);

            // every input determine a choice and it's name has number which tell you which style is that
            foreach ($user_choises as $choise) {
                if (strpos($choise, '1') !== false) {
                    $romantic = $romantic + 1;
                }
                if (strpos($choise, '2') !== false) {
                    $classic = $classic + 1;
                }
                if (strpos($choise, '3') !== false) {
                    $Casual = $Casual + 1;
                }
                if (strpos($choise, '4') !== false) {
                    $dramatic = $dramatic + 1;
                }
                if (strpos($choise, '5') !== false) {
                    $Bohemian = $Bohemian + 1;
                }
                if (strpos($choise, '6') !== false) {
                    $Ancient = $Ancient + 1;
                }
                if (strpos($choise, '7') !== false) {
                    $Gamine = $Gamine + 1;
                }
            }

            //to get the maximum choices number
            $styles = array($romantic, $classic, $Casual, $dramatic, $Bohemian, $Ancient, $Gamine);
            $value = max($styles);

            if ($romantic == $value) {
                $style[] = "Romantic";
            }
            if ($classic == $value) {
                $style[] = "Classic";
            }
            if ($Casual == $value) {
                $style[] = "Casual";
            }
            if ($dramatic == $value) {
                $style[] = "Dramatic";
            }
            if ($Bohemian == $value) {
                $style[] = "Bohemian";
            }
            if ($Ancient == $value) {
                $style[] = "Ancient";
            }
            if ($Gamine == $value) {
                $style[] = "Gamine";
            }

            //check style type , single or composite
            if (count($style) == 1) {
                $style_type = "single";
                $result = $style[0];
            } else {
                $style_type = "composite";
                $result[] = $style[0]; // thats the first style
                $result[] = $style[1]; // thats the second style
            }

            //because first_exam column with json datatype
            $exam = array(
                'style_type' => $style_type,
                "style" => $result, // if single then result will be sting and if composite will be array of two styles
                "user choices" => $request->all()
            );


            // //find if user exams results was exists or not
            $user_exam = ExamsResult::where('user_id', '=', Auth()->user()->id)->get();

            // if count of user greater than 0 , it means that he has rows befor show so he tested befor , then we just should edit exam result
            if (count($user_exam) != 0) {
                $user_exam = ExamsResult::find($user_exam[0]->id);
                $user_exam->update([
                    "third_exam" => json_encode($exam),
                    'note' => $request->note,
                ]);
            } else {
                // it means that it's the first test for the user
                $user_exam = ExamsResult::create([
                    "third_exam" => json_encode($exam),
                    "user_id" => Auth()->user()->id,
                    'note' => $request->note,
                ]);
            }
            return $this->returnData('data', $result);
        } catch (\Exception $e) {
            return $this->returnError(202, $e->getMessage());
        }
    }
}
