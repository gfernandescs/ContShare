<?php

namespace App\Http\Controllers;

use Auth;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Followers;
use App\File;
use App\User;
use App\NotificationUsers;

class PagesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['getProfile']]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function getIndex()
    {
        $groups        = File::distinct()->select('group')->where('id_user', '=', auth()->user()->id)->groupBy('group')->get();
        $user          = User::find(auth()->user()->id);
        $n_folls       = $user->followings;
        $followings    = array();
        $cont          = 0;

        foreach ($n_folls as $following ) {
           $followings[$cont] = User::find($following->id_follower);
           $cont ++;
        } 
        $notifications =  NotificationUsers::select('id_notification')
                                          ->where('id_user', auth()->user()->id)
                                          ->where('is_read', 0)
                                          ->orderBy('id_notification', 'desc')
                                          ->count();   

        return view('layouts.main',[
            'groups' => $groups,
            'notifications' =>$notifications,
            'followings' => $followings
        ]);
    }

    public function getProfile(int $id){

        $followers_user   = User::find($id);

        $user             = User::where('id', $id)->get();
        $groups           = File::distinct()->select('group')->where('id_user', '=', $id)->groupBy('group')->get();
        $count_files      = File::all()->where('id_user', $id)->where('private', "n")->count();
        $count_followings = $followers_user->followings->count();
        $count_followers  = $followers_user->followers->count();

        if(Auth::check()){

            //Notificações
            $notifications =  NotificationUsers::select('id_notification')
                                          ->where('id_user', auth()->user()->id)
                                          ->where('is_read', 0)
                                          ->orderBy('id_notification', 'desc')
                                          ->count();

            $groups_modal  = File::distinct()->select('group')->where('id_user', '=', auth()->user()->id)->groupBy('group')->get();

            $total         = array();
            $is_following  = array();
            $user_on       = User::find(auth()->user()->id);
            $user_on_folls = $user_on->followings;
            $cont          = 0;

            foreach ($user_on_folls as $following) {
                $total[$cont] = $following->id_follower;
                $cont ++;
            }

            if(in_array($id, $total)){
                $is_following['is'] = true;
                $key                = array_search($id,$total);
                $is_following['id'] = Followers::where('id_user', auth()->user()->id)
                                                    ->where('id_follower', $total[$key] )
                                                    ->value('id');
            }else{
                $is_following = false;
            }
        }else{
            $groups_modal = false;
            $is_following = false;
        }

        return view('layouts.profile',[
            'users'            => $user,
            'groups'           => $groups,
            'groups_modal'     => $groups_modal,
            'count_files'      => $count_files,
            'count_followings' => $count_followings,
            'count_followers'  => $count_followers,
            'is_following'     => $is_following,
            'notifications'    => $notifications
        ]);
    }
}
