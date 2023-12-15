<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{

  public function login()
  {
    return view('auth.login')->with('route', route('loginPost'));
  }

  public function loginProcces(Request $request)
  {
    $this->validate($request, [
      'email' => 'required|email',
      'password' => 'required'
    ]);

    if (Auth::guard()->attempt(['email' => $request->email, 'password' => $request->password])) {
      return redirect()->intended('/wardrobe');
    } else {
      return redirect()->back()->with('error', 'Email atau Password salah');
    }
  }

  public function signup()
  {
    return view('auth.signup')->with('route', route('signupPost'));
  }

  public function signupProcces(Request $request)
  {
    $this->validate($request, [
      'email' => 'required|email',
      'password' => 'required',
      'name' => 'required|min:3'
    ]);

    $user = new User();
    $this->saveUser($user, $request);

    if (Auth::guard()->attempt(['email' => $request->email, 'password' => $request->password, 'name' => $request->name])) {
      return redirect()->intended('/wardrobe');
    }
  }

  public function saveUser($item, $request)
  {
    Validator::make($request->all(), [
      'name' => 'required|min:3',
      'password' => 'required',
      'email' => 'required|email',
    ])->validate();

    $item->name = $request->name;
    $item->password = Hash::make($request->password);
    $item->email = $request->email;
    $item->save();
  }
}
