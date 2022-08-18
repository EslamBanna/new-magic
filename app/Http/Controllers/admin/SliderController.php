<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use App\Models\Organizer;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

use Auth;

class SliderController extends Controller
{
    use GeneralTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $slider_images = Slider::all();
        foreach ($slider_images as $slider_image) {
            $organizer = Organizer::find($slider_image->organizer_id);
            $slider_image["addedBy_name"] = $organizer->name;
        }
        // return $slider_images;
        return view('admin.slider_images', ["slider_images" => $slider_images]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.addnewSliderImg');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $file = $request->file('image');
        if (!$file) return redirect(route('slider.index'));
        // $extension = $file->getClientOriginalExtension();
        // $filename = time() . '.' . $extension;
        // $file->move('admin/slider_images/', $filename);
        // Slider::create([
        //     "organizer_id" => Auth::user()->id,
        //     "image_path" => $filename
        // ]);

        $slider = $this->saveImage($request->file('image'), 'slider');
        Slider::create([
            'image_path' => $slider,
            'organizer_id' => Auth()->user()->id,
            'title_en' => $request->title_en,
            'description_en' => $request->description_en,
            'title_ar' => $request->title_ar,
            'description_ar' => $request->description_ar
        ]);
        return redirect(route('slider.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function show(Slider $slider)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function edit(Slider $slider)
    {
        //
        return view("admin.editSliderImg", ["slider" => $slider]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Slider $slider)
    {

        // if ($request->file('image')) {
        //     $file = $request->file('image');
        //     $extension = $file->getClientOriginalExtension();
        //     $filename = time() . '.' . $extension;
        //     $file->move('admin/slider_images/', $filename);
        //     $image_path = "admin/slider_images/$slider[image]";  // Value is not URL but directory file path
        //     if (File::exists($image_path)) {
        //         File::delete($image_path);
        //     }
        // } else {
        //     $filename = $slider['image_path'];
        // }


        // $slider->update([
        //     "organizer_id" => Auth::user()->id,
        //     "image_path" => $filename,
        // ]);

        $slider = Slider::find($slider->id);
    
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

        return redirect(route('slider.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function destroy(Slider $slider)
    {
        //deleting slider images from ther server slider_images filder
        $image_path = "admin/slider_images/" . $slider['image_path'];
        if (File::exists($image_path)) {
            File::delete($image_path);
        }

        $slider->delete();
        return redirect(route('slider.index'));
    }
}
