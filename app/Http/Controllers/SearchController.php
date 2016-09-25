<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;
use App\File;

class SearchController extends Controller
{
    
    public function searchUsers($value = 0)
    {
        $users = User::where('name','LIKE', '%'.$value.'%')
                           ->orwhere('last_name', 'LIKE', '%'.$value.'%')
                           ->take(8)
                           ->get();

        return view('includes.searchUsers',[
            'users' => $users,
            'value' => $value
            ]);                         
    }
    
    public function searchConts($id_user, $value, int $profile = 0)
    {
        
        if($profile){
            if($id_user == auth()->user()->id){
                $main_user = true;
            }else{
                $main_user = false;
            }
            $files = File::where('id_user', $id_user)
                           ->where('comment','LIKE', '%'.$value.'%')
                           ->where('private', "n")
                           ->orderBy('group', 'asc')
                           ->get();

            return view('files',[
                'files'        => $files,
                'number_group' => 0,
                'g'            => "",
                'profile'      => $main_user,
                'is_search'    => true
            ]);
        }else{

            $files = File::where('id_user', auth()->user()->id)
                           ->where('comment','LIKE', '%'.$value.'%')
                           ->orderBy('group', 'asc')
                           ->get();

             return view('files',[
                'files'        => $files,
                'number_group' => 0,
                'g'            => "",
                'is_search'    => true
            ]);
        }
        
        
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
