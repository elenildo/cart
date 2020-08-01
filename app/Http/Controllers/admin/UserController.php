<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\{User, Role};

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->isAdmin() ) {
            $users = User::paginate(10);
        } else {
            $users = User::whereHas('roles', function($query){ 
                $query->whereNotIn('role_id', [1]); //Exibe somente usuários não admin
            })->paginate(10);
        }
       
        return view('admin.users', compact('users'));
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
        $user = User::find($id);
        $allRoles = Auth::user()->isAdmin()? Role::all() : Role::where('id', '<>', 1)->get();
        
        if (Auth::user()->roles()->orderBy('id')->first()->id >= $user->roles()->orderBy('id')->first()->id && Auth::user()->id != (int)$id ){
            return redirect()->route('admin.usuarios');
        }
    
        return view('admin.user', compact('user','allRoles'));
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
        $user = User::find($id);

        if ($user) {
            $user->roles()->sync($request->roles);
            return redirect()->route('admin.usuarios');
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
        //
    }
}
