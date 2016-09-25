<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\File;
use App\User;
use App\Http\Controllers\NotificationController;
use Session;

class FileController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index($id = null)
    {
        if(!$id){
            $id = auth()->user()->id;
            $is_profile = 0;
        }else{
            $is_profile = 1;
        }
        $groups = File::distinct()->select('group')->where('id_user', '=', $id)->groupBy('group')->get();
        return view('groups',['groups' => $groups, 'is_profile' => $is_profile, 'id_user' => $id]);
    }

    public function getFiles(Request $request, $groups)
    {
        $files = File::all()->where('id_user', auth()->user()->id)->where('group', $groups);

        if($request->ajax()){
            return view('files',[
                'files'     => $files,
                'group'     => $groups,
                'g'         => "",
                'is_search' => false
            ]);
        }else{
           return redirect('/')->with('no_ajax', $request->path());
        }
    }

    public function getFilesProfile(Request $request, int $id = null, $groups, int $id_file = null)
    {
        if(!$id){
            $id = auth()->user()->id;
        }
        $profile = true;
        $files   = File::all()->where('id_user', $id)->where('group', $groups)->where('private', "n");

        if($id === auth()->user()->id){
            $profile = true;
        }else{
            $profile = false;
        }

        if($request->ajax()){
            return view('files',[
                'files'   => $files,
                'profile' => $profile,
                'g'       => "",
                'id_file' => $id_file
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
                'url' => 'required',
                'group_s' =>'required',
                'comments' =>'required'
        ));

        $file = new File;

        $file->id_user = auth()->user()->id;
        $file->url     = $request->url;
        $file->group   = $request->group_s;
        $file->comment = $request->comments;

        if($request->priv){
            $file->private = "s";
        }else{
            $file->private = "n";
        }
         
        $file->save();

        //Salva uma notificação---------------------------------
        $notification = new NotificationController;
        $notification->store($file->id_user);


        //Salva uma notificaçãoUsers-----------------------------
        $notificationUsers = new NotificationUsersController;
        $user_on        = User::find(auth()->user()->id);
        $user_on_folls  = $user_on->followers;
        
        foreach ($user_on_folls as $followers){
            $notificationUsers->store($followers->id_user); 
        } 

        Session::flash('success', 'Link Salvo :)');
        return redirect('/');
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
        if($id){
            $this->validate($request, array(
                    'url_up' => 'required',
                    'group_up' =>'required',
                    'comments_up' =>'required'
            ));

            $file = File::find($id);

            $file->id_user = auth()->user()->id;
            $file->url     = $request->input("url_up");
            $file->group   = $request->input("group_up");
            $file->comment = $request->input("comments_up");
            $file->save();
        }else{
            //Atualiza apenas o titulo do grupo
            $this->validate($request, array(
                    'title' => 'required',
                    'old_title' =>'required',
            ));
            File::where('group', $request->input("old_title"))
                ->where('id_user', auth()->user()->id)
                ->update(['group' => $request->input("title")]);

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $notification = new NotificationController;

        $file            = File::find($id);
        $notification_id = File::find($id)->notification;

        $file->delete(); 
        $notification->destroy($notification_id->id);
    }
}
