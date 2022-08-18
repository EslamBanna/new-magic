<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use App\Http\Requests\StoreSliderRequest;
use App\Http\Requests\UpdateSliderRequest;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    use GeneralTrait;
    public function createSlider(Request $request)
    {
        try {
            $validate = validator($request->all(), [
                'image' => 'required|mimes:jpeg,jpg,png,gif|max:2048',
                'title_en' => 'string|max:255',
                'description_en' => 'string|max:255',
                'title_ar' => 'string|max:255',
                'description_ar' => 'string|max:255',
            ]);
            if ($validate->fails()) {
                return $this->returnError(202, $validate->errors()->first());
            }
            $slider = $this->saveImage($request->file('image'), 'slider');
            Slider::create([
                'image_path' => $slider,
                'organizer_id' => Auth()->user()->id,
                'title_en' => $request->title_en,
                'description_en' => $request->description_en,
                'title_ar' => $request->title_ar,
                'description_ar' => $request->description_ar
            ]);
            return $this->returnSuccessMessage('success');
        } catch (\Exception $e) {
            return $this->returnError(201, $e->getMessage());
        }
    }

    public function getSliders(Request $request)
    {
        try {
            $lang = $request->header('lang') ?? 'en';
            if($lang != 'ar' && $lang != 'en'){
                return $this->returnError(201, 'lang is not valid');
            }
            $sliders = Slider::select(
                'id',
                'image_path',
                'title_' . $lang . ' as title',
                'description_' . $lang . ' as description'
            )->get();
            return $this->returnData('data', $sliders);
        } catch (\Exception $e) {
            return $this->returnError(201, $e->getMessage());
        }
    }

    public function deleteSlider($slider_id)
    {
        try {
            $slider = Slider::find($slider_id);
            if (!$slider) {
                return $this->returnError(201, 'this slider is not existed');
            }
            $slider->delete();
            return $this->returnSuccessMessage('success');
        } catch (\Exception $e) {
            return $this->returnError(201, $e->getMessage());
        }
    }

    public function updateSlider($slider_id, Request $request)
    {
        try {
            $validate = validator($request->all(), [
                'image' => 'required|mimes:jpeg,jpg,png,gif|max:2048',
                'title_en' => 'string|max:255',
                'description_en' => 'string|max:255',
                'title_ar' => 'string|max:255',
                'description_ar' => 'string|max:255',
            ]);
            if ($validate->fails()) {
                return $this->returnError(202, $validate->errors()->first());
            }
            $slider = Slider::find($slider_id);
            if (!$slider) {
                return $this->returnError(201, 'this slider is not existed');
            }
            $slider->delete();
            $slider = $this->saveImage($request->file('image'), 'slider');
            Slider::create([
                'image_path' => $slider,
                'organizer_id' => Auth()->user()->id,
                'title_en' => $request->title_en,
                'description_en' => $request->description_en,
                'title_ar' => $request->title_ar,
                'description_ar' => $request->description_ar
            ]);
            return $this->returnSuccessMessage('success');
        } catch (\Exception $e) {
            return $this->returnError(201, $e->getMessage());
        }
    }
}
