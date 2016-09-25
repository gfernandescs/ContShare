<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Notification;
use App\File;
use Jenssegers\Date\Date;
use App\User;
use App\NotificationUsers;

class NotificationUsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = array();
        $file = array();
        $notification = array();

        $notifications = NotificationUsers::select('id_notification','is_read')
                                          ->where('id_user', auth()->user()->id)
                                          ->orderBy('id_notification', 'desc')
                                          ->get();

                                         
        foreach ($notifications as $result){
            //Atualiza as notificações como lidas
            if($result->is_read == 0){
                NotificationUsersController::update($result->id_notification,auth()->user()->id);
            }

            $noti = Notification::find($result->id_notification);

            $notification[$result->id_notification]['notification'] = $noti;
            $notification[$result->id_notification]['user']         = User::find($noti->user_id);
            $notification[$result->id_notification]['file']         = File::find($noti->file_id);

        }

        //Exclui NotificaçõesUsers antigas
        if(count($notifications) > 30){
            $limit = count($notifications) - 30;
            NotificationUsersController::destroy($limit);
            
        }
        return view('notifications',[
            'notifications' => $notification
        ]);
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
    public function store($id_user)
    {
        $id_notification = Notification::select('id')->where('user_id', auth()->user()->id)->get()->last();

        $notificationUsers = new NotificationUsers;

        $notificationUsers->id_notification = $id_notification->id;
        $notificationUsers->id_user         = $id_user;
        $notificationUsers->is_read         = 0;

        $notificationUsers->save();
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
    public function update($id_notification, $id_user)
    {   
            $notification = NotificationUsers::where('id_user', $id_user)
                                             ->where('id_notification', $id_notification)->first();
            $notification->is_read = 1;
            $notification->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($limit)
    {
        NotificationUsers::where('id_user', auth()->user()->id)
                            ->orderBy('id_notification', 'asc')
                            ->limit($limit)
                            ->delete();
    }
}
