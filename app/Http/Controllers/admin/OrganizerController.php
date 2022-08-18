<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Organizer;
use Illuminate\Http\Request;

class OrganizerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $numOfAdmins = 0;
        $organizers = Organizer::all();
        foreach ($organizers as $organizer) {
            if ($organizer['role'] == 'admin') $numOfAdmins++;
        }
        return view('admin.organizers', ['organizers' => $organizers, 'numOfAdmins' => $numOfAdmins]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.addOrganizer');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            "name" => "required",
            "email" => "required",
            "password" => "required",
            "role" => "required"
        ]);
        $organizers = Organizer::all();
        foreach ($organizers as $organizer) {
            if ($organizer["email"] == $request["email"]) {
                function function_alert($message)
                {

                    // Display the alert box
                    echo "<script>alert('$message');</script>";
                }


                // Function call
                function_alert("Sorry email exists! , enter onother one");
                return view('admin.addOrganizer');

            }
        }
        Organizer::create([
            "name" => $request["name"],
            "email" => $request["email"],
            "password" => bcrypt($request["password"]),
            "phone" => $request["phone"],
            "role" => $request["role"],
            "consultant_category" => $request["category"],
        ]);

        return redirect(route('organizers.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Organizer $organizer
     * @return \Illuminate\Http\Response
     */
    public function show(Organizer $organizer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Organizer $organizer
     * @return \Illuminate\Http\Response
     */
    public function edit(Organizer $organizer)
    {
        //
        return view("admin.editOrganizer", ["organizer" => $organizer]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Organizer $organizer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Organizer $organizer)
    {
        //
        $organizer->update([
            "name" => $request["name"],
            "email" => $request["email"],
            "password" => bcrypt($request["password"]),
            "phone" => $request["phone"],
            "role" => $request["role"],
            "consultant_category" => $request["category"]

        ]);
        return redirect(route("organizers.index"));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Organizer $organizer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Organizer $organizer)
    {
        //
        $organizer->delete();
        return redirect(route('organizers.index'));
    }

}
