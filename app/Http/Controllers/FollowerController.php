<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Followers;
use App\File;
use App\User;
use App\Http\Requests;

class FollowerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $id)
    {
        $count_files  = array();
        $total        = array();
        $followers    = array();
        $is_following = array();

        if(Auth::check()){
            $user_on        = User::find(auth()->user()->id);
            $user_on_folls  = $user_on->followings;
            $cont = 0;

            foreach ($user_on_folls as $following) {
                $total[$cont] = $following->id_follower;
                $cont ++;
            }
        }else{
            $total[]  = 0;
        }

        $cont  = 0; 
        $user  = User::find($id);
        $users = $user->followers;
        foreach ($users as $follower) {

            $count_files[$follower->id_user] = File::all()->where('id_user', $follower->id_user)->where('private', "n")->count();
            
            $followers[$cont] = User::find($follower->id_user);

            if(in_array($follower->id_user, $total)){
                
                $key                = array_search($follower->id_user,$total);
                $is_following[$follower->id_user] = Followers::where('id_user', auth()->user()->id)
                                                        ->where('id_follower', $total[$key] )
                                                        ->value('id');
            }else{
                $is_following[$follower->id_user] = false;
            }

            $cont ++;
        }

        if($request->ajax()){
            return view('followers',[
                'followers'     => $followers, 
                'user_on_folls' => $total,
                'count_files'   => $count_files,
                'is_following'  => $is_following
            ]);
        }else{
           return redirect('/'.$id)->with('no_ajax', $request->path());
        }
        
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
