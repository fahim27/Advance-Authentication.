<?php

namespace App\Http\Controllers;

use http\Client\Curl\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function passwordChange()

    {

        return view('auth.passwordChange');
    }

    public function oldPassword(Request $request)
    {

        $validator = Validator::make($request->all(), [

            'old_password' => 'required',

        ]);

        if (!$validator->fails()) {
            $current_password = Auth::User()->password;


            if (Hash::check($request->old_password, $current_password)) {
                return response()->json([
                    'success' => "OK",
                    'message'=>'Password match'


                ]);
            }
        }
        return response()->json([
            'success' => 'FALD',
            'errors' => $validator->errors()->all()
        ]);


        # code...
    }

    public function newPassword(Request $request)
    {

        $validator = Validator::make($request->all(), [

            'new_password' => 'required',

        ]);
        $user =\App\User::where('email',Auth::user()->email)->first();
        $user->password=$request->new_password;
        if ($user->save()){
            return response()->json([
                'success' => "OK",
                'message'=>'Password Change Successfully'

            ]);
        }

    }
}
