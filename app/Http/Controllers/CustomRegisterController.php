<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use App\History;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class CustomRegisterController extends Controller
{
    public function index()
    {
    	if (Auth::guest())
    	{
    		return Redirect('/');
    	}
    }

    public function login()
    {
      $UserDb = User::all();
      if(!count($UserDb))
      {
          return redirect('/register');
      }

      return view('auth.login');
    }

    public function register()
    {
      $UserDb = User::all();
      if(count($UserDb))
      {
          return redirect('/login');
      }

      return view('auth.register');
    }



    //Validates Input
    public function submit(Request $request){
      $this->validate($request, [
          'name' => ['required', 'string', 'max:50'],
          'username' => ['required', 'string', 'max:25', 'unique:users'],
          'password' => ['required', 'confirmed', 'string', 'max:25', 'min:8'],
      ]);

      $UserDb = User::all();
      if(count($UserDb))
      {
          return redirect('/login');
      }

      //Registers the User
      $UserDB = new User;
      $UserDB->name = $request->input('name');
      $UserDB->username = $request->input('username');
      $UserDB->password =  Hash::make($request->input('password'));
      $UserDB->save();

      $History = new History;
      $History->name = $request->input('name');
      $History->action = "Created an Account";
      $History->target = $request->input('name');
      $History->other_details = "First Superadmin account";
      $History->save();

      //Redirect to Login
      Auth::logout();
      return redirect('/');
    }
}
