<?php

namespace App\Http\Controllers\auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{


    public function login_view()
    {
        return view('auth.login');
    }


    public function login(Request $request)
    {
        $request->validate([
            'email' => ['required'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($request->except(['_token']))) {
            return  redirect()->route('dashboard');
        } else {
            return redirect()->route('login')->with('error', 'Invalid Combination');
        }
    }

    public function register_view()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        // return "hello user";

        $request->validate([
            'name' => ['required'],
            'email' => ['required', 'unique:users,email'],
        ]);
        if (!empty($request->phone)) {
            $request->validate([
                'phone' => ['unique:users,contact_no']
            ]);
        }
        if (!empty($request->picture)) {
            $request->validate([
                'picture' => ['mimes:png,jpg,jpeg']
            ]);

            $file = $request->picture;
            $file_name = 'aci-' . time() . '-' . $file->getClientOriginalName();
        } else {
            $file_name = 'avatar.png';
        }

        // dd($file_name);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'contact_no' => $request->phone,
            'password' => Hash::make($request->password),
            'image' => $file_name,
            'dob' => $request->dob,
            'address' => $request->address,
            'user_type' => 'Student',
        ];
        // return "hello user";

        $is_user_created = User::create($data);

        if ($is_user_created) {
            $file = $request['picture'];
            $file->move(public_path('student_uploads'), $file_name);
            return back()->with('success', 'User has been created succesfully');
        }else{
            return back()->with('error', 'User has failed to create');

        }
    }





    public function logout()
    {
        Auth::logout();
        return redirect()->route('login')->with('success', 'Seccesfully Logout');
    }
}
