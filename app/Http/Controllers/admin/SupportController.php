<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Organizer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class SupportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('admin.support');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Organizer  $organizer
     * @return \Illuminate\Http\Response
     */
    public function show(Organizer $organizer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Organizer  $organizer
     * @return \Illuminate\Http\Response
     */
    public function edit($organizer)
    {
        //
        $organizer=Organizer::find($organizer);
        return view("admin.support",["organizer"=>$organizer]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Organizer  $organizer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Organizer $organizer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Organizer  $organizer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Organizer $organizer)
    {
        //
    }
    //Send email to admin
    public function contactemail(Request $request)
    {



        // Login Section
        $subject = "Email From Of ".$request->name;
        $to = "magicthestyle@gmail.com";
        $name = $request->name;
        $about = $request->subject;
        $from = $request->email;
        $want_to_contact=$request->admin_email;
        $msg = "\nMessage: ".$request->message;



//            $headers = "From: ".$gs->from_name."<".$gs->from_email.">";
//            mail($to,$subject,$msg,$headers);


        $email = $request->email;
        $messageData = ['email'=>$request->email,'name'=>$request->name,'about'=>$request->about,'msg'=>$msg,'WantToContact'=>$want_to_contact];
        // Mail::send('user.contact_emial',$messageData,function($msg) use($to){
        //     $msg->to($to)->subject('Contact Message');
        // });
        // Login Section Ends

        // Redirect Section
        return redirect()->back()->with(['success' => 'Contact Successfully']);
    }
}
