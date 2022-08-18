<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\ExamsResult;
use Illuminate\Http\Request;
use DB;
class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $face_tested=0;
        $body_tested=0;
        $style_tested=0;
        $users = User::all();
        foreach($users as $user){
            $user_exams= DB::table('exams_results')->where('user_id', '=',$user->id)->get(); 
            if(count($user_exams)!=0){
                $user_exam=ExamsResult::find($user_exams[0]->id);
                $user['first_exam']=json_decode($user_exam->first_exam);
                $user['second_exam']=json_decode($user_exam->second_exam);
                $user['third_exam']=json_decode($user_exam->third_exam);
                if(isset($user_exam->first_exam)){
                    $face_tested++;
                }
                if(isset($user_exam->second_exam)){
                    $body_tested++;
                }
                if(isset($user_exam->third_exam)){
                    $style_tested++;
                }
            }
               

        }

        return view('admin.users', ['users' => $users,'face_tested'=>$face_tested,'body_tested'=>$body_tested,'style_tested'=>$style_tested]);
    

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.addUser');
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
        $user = new User;
        $data = $request->all();
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->password = bcrypt($data['password']);
        $user->save();
        return redirect(route('users.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
        $user->delete();
        return redirect(route('users.index'));
    }
}
