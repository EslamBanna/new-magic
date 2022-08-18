<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\CunsultantPackage;
use App\Models\Organizer;
use App\Models\Feature;
use App\Models\consultantTest;
use App\Models\CunsultantPackages;
use App\Models\CunsultantTests;
use Illuminate\Http\Request;
use DB;

class ConsultantPackageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $ConsultantPackages = CunsultantPackages::all();

        // get consultant package features
        foreach ($ConsultantPackages as $ConsultantPackage) {
            $features = $ConsultantPackage["cons_package_features"];
            $ConsultantPackage["features"] = $features;
        }
        return view('admin.consultant_packages', ['ConsultantPackages' => $ConsultantPackages]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $consultants = [];
        $organizers = Organizer::all();
        foreach ($organizers as $organizer) {
            if ($organizer["role"] === "consultant") {
                $consultants[] = $organizer;
            }
        }
        return view('admin.addConsultant_packages', ["consultants" => $consultants]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        //  dd($request->all());
        //        $request->validate([
        //            "type"=>"required",
        //            "type_ar"=>"required",
        //            "price"=>"required",
        //            "description"=>"required",
        //            "description_ar"=>"required",
        //
        //        ]);
        // $cunsultantPackage=CunsultantPackages::create([
        //     "consultation_type_en" => $request["type"],
        //     "consultation_type_ar" => $request["type_ar"],
        //     "description_en" => $request["description"],
        //     "description_ar" => $request["description_ar"],
        //     "price" => $request["price"],
        // ]);

        CunsultantPackages::create([
            'description_en' => $request['description'],
            'description_ar' => $request->description_ar,
            'price' => $request['price'],
            'consultation_type_en' => $request["type"],
            'consultation_type_ar' => $request["type_ar"],
        ]);

        // $cons_id=$cunsultantPackage->id;

        // if($request->features_en) {

        //     $interest_array = $request->features_en;
        //     $far = $request->features_ar;
        //     $pr =  $request->prices;
        //     $chk =  $request->checked;
        //     $array_len = count($interest_array);
        //     for ($i = 0; $i < $array_len; $i++) {

        //       //   dd($far[1]);
        //      if (!empty( $interest_array[$i] ) && !empty( $far[$i] ) && isset( $pr[$i] )) {
        //          $related = new Feature();
        //          $related->feature = $interest_array[$i];
        //          $related->feature_ar = $far[$i];
        //          $related->price = $pr[$i];
        //          $related->checked = $chk[$i];
        //          $related->consultant_pack_id = $cons_id;

        //          $related->save();
        //      }else {
        //         continue;
        //      }


        //     }

        // }

        return redirect(route('consultant-packages.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CunsultantPackage  $cunsultantPackage
     * @return \Illuminate\Http\Response
     */
    public function show(CunsultantPackages $cunsultantPackage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CunsultantPackage  $cunsultantPackage
     * @return \Illuminate\Http\Response
     */
    public function edit($cunsultantPackage)
    {
        //
        $id = $cunsultantPackage;
        $consultants = [];
        $organizers = Organizer::all();
        foreach ($organizers as $organizer) {
            if ($organizer["role"] === "consultant") {
                $consultants[] = $organizer;
            }
        }
        $cunsultantPackage = DB::table('cunsultant_packages')->where('id', '=', $cunsultantPackage)->get();
        // $features = DB::table('features')->where('consultant_pack_id', '=', $id)->get();
        $features=[];
        return view("admin.editConsultant_packages", ["cunsultantPackage" => $cunsultantPackage, "consultants" => $consultants, "features" => $features]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CunsultantPackage  $cunsultantPackage
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $cunsultantPackage)
    {
        //
        //        $request->validate([
        //            "type"=>"required",
        //            "type_ar"=>"required",
        //            "price"=>"required",
        //            "description"=>"required",
        //            "description_ar"=>"required",
        //
        //        ]);


        //dd($request->all());

        $id = $cunsultantPackage;
        $cunsultantPackage = CunsultantPackages::find($id);
        $cunsultantPackage->update([
            "consultation_type_en" => $request["type"],
            "consultation_type_ar" => $request["type_ar"],
            "description_en" => $request["description"],
            "description_ar" => $request["description_ar"],


        ]);


        // $features = Feature::where('consultant_pack_id', '=', $id)->get();

        // foreach ($features as $feature) {
        //     if (!empty($feature)) {
        //         $feature->delete();
        //     }
        // }



        // if ($request->features_en || $request->features_ar) {



        //     $interest_array = $request->features_en;
        //     $far = $request->features_ar;
        //     $pr =  $request->prices;
        //     $chk =  $request->checked;
        //     $array_len = count($interest_array);
        //     for ($i = 0; $i < $array_len; $i++) {

        //         //   dd($far[1]);
        //         if (!empty($interest_array[$i]) && !empty($far[$i])) {

        //             $related = new Feature();
        //             $related->feature = $interest_array[$i];
        //             $related->feature_ar = $far[$i];
        //             $related->price = $pr[$i];
        //             $related->checked = $chk[$i];
        //             $related->consultant_pack_id = $id;

        //             $related->save();
        //         } else {
        //             continue;
        //         }
            // }
    // }

// }


        // for($i=0;$i<count($features);$i++){

        //            $feature_one=Feature::find($features[0]->id);
        //            if(isset($request["feature_one"])&&count($features)>0){
        //            $feature_one->update([
        //                "feature" => $request["feature_one"],
        //                "feature_ar" => $request["feature_one_ar"],
        //                "consultant_pack_id" => $id,
        //                ]);
        //            }
        //            if(isset($request["feature_two"])&&count($features)==3){
        //                $feature_two=Feature::find($features[1]->id);
        //                $feature_two->update([
        //                    "feature" => $request["feature_two"],
        //                    "feature_ar" => $request["feature_two_ar"],
        //                    "consultant_pack_id" => $id,
        //                ]);
        //            }
        //            if(isset($request["feature_three"])&&count($features)==3){
        //                $feature_three=Feature::find($features[2]->id);
        //                $feature_three->update([
        //                    "feature" => $request["feature_three"],
        //                    "feature_ar" => $request["feature_three_ar"],
        //                    "consultant_pack_id" => $id,
        //                ]);
        //            }
        //
        //            // if no features before
        //            if(isset($request["feature_one"])&&count($features)==0){
        //                Feature::create([
        //                    "feature" => $request["feature_one"],
        //                    "feature_ar" => $request["feature_one_ar"],
        //                    "consultant_pack_id" => $id,
        //                    ]);
        //                }
        //                if(isset($request["feature_two"])&&count($features)<2){
        //                    Feature::create([
        //                        "feature" => $request["feature_two"],
        //                        "feature_ar" => $request["feature_two_ar"],
        //                        "consultant_pack_id" => $id,
        //                    ]);
        //                }
        //                if(isset($request["feature_three"])&&count($features)<3){
        //                    Feature::create([
        //                        "feature" => $request["feature_three"],
        //                        "feature_ar" => $request["feature_three_ar"],
        //                        "consultant_pack_id" => $id,
        //                    ]);
        //                }
        //        // }

        return redirect(route("consultant-packages.index"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CunsultantPackage  $cunsultantPackage
     * @return \Illuminate\Http\Response
     */

    public function destroy($cunsultantPackage)
    {
        //
        DB::table('cunsultant_packages')->where('id', '=', $cunsultantPackage)->delete();
        return redirect(route('consultant-packages.index'));
    }

    public function getalltests()
    {


        $all_tests = CunsultantTests::all();

        return view('admin.consult_tests', compact('all_tests'));
    }
}
