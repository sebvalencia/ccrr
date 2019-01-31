<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Hash;
use App\Http\Requests\admin\user\StoreUsers;
use App\Http\Requests\admin\user\UpdateUsers;

class AdminUsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
      public function __construct()
    {
        $this->middleware('auth:admin');
    }

    
    public function index()
    {
        //
          $users=User::all();
        return view('admins.users.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
         return view('admins.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUsers $request)
    {
        //
        $validated = $request->validated();


        $data=array(

            'name'=>$request->input('name'), 
            'email'=>$request->input('email') , 
            'password'=>Hash::make($request->input('password')),
         



        );

        User::create($data);

        return redirect()->route('users.index')->with('message_store', true);
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
          $user=User::find($id);
        return view('admins.users.edit',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUsers $request, $id)
    {
        //
         $validated = $request->validated();


        $user=User::find($id);

        if ($request->password) {
            $password= Hash::make($request->input('password'));
        } else {
            $password=$user->password;
        }

        $data = array(
            'name' => $request->input('name'),         
            'email' => $request->input('email'),           
            'password' =>$password,
        );

        $user->update($data);
        
        return redirect()->route('users.index')->with('message_update', true);
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
          User::destroy($id);
         return redirect()->route('users.index')->with('message_destroy', true);
    }
}
