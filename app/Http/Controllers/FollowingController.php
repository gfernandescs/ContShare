<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Followers;
use App\File;
use App\User;
use App\Http\Requests;

class FollowingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, int $id)
    {
        $count_files  = array();
        $total        = array();
        $followings   = array();
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
 

        $cont = 0; 
        $user = User::find($id);
        $users = $user->followings;
        foreach ($users as $following) {

            $count_files[$following->id_follower] = File::all()
                                                    ->where('id_user', $following->id_follower)
                                                    ->where('private', "n")->count();

            $followings[$cont] = User::find($following->id_follower);

            if(in_array($following->id_follower, $total)){
                
                $key = array_search($following->id_follower,$total);
                $is_following[$following->id_follower] = Followers::where('id_user', auth()->user()->id)
                                                        ->where('id_follower', $total[$key] )
                                                        ->value('id');
            }else{
                $is_following[$following->id_follower] = false;
            }


            $cont ++;
        }

        if($request->ajax()){
            return view('followings',[
                'followings'    => $followings, 
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
        $this->validate($request, array(
                'id_user' => 'required',
                'id_follower' =>'required'
        ));

        $following = new Followers;

        $following->id_user     = $request->id_user;
        $following->id_follower = $request->id_follower;

        $following->save();
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
        $following = Followers::find($id);
        $following->delete(); 
    }
}
