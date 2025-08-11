<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use function Laravel\Prompts\alert;

class AuthController extends Controller
{


    public function showLoginForm()
    {
        return view('admin.auth.login');
    }

    public function authentication(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email'    => 'required|email|exists:users,email',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ]);
        }


        // Attempt to login
        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json([
                'status'  => false,
                'message' => 'Wrong credentials'
            ], 401);
        }

        $user = Auth::user();

        // Check if user has 'admin' role (assuming User model has hasRole method)
        if (!$user->hasRole('admin')) {
            Auth::logout();
            return response()->json([
                'status'  => false,
                'message' => 'You are not an admin'
            ]);
        }



        // Successful login with admin role
        return response()->json([
            'status'  => true,
            'message' => 'Login successful',
            'user' => $user,
        ]);
    }



    public function showSignupForm()
    {
        return view('admin.auth.singup');
    }



    public function signupProcess(Request $request)
    {

        // dd($request->all());

        $validation = Validator::make($request->all(), [

            'first_name' => 'required|string|max:50',
            'last_name'  => 'string|max:50|nullable',
            'email'      => 'required|string|email|unique:users,email',
            'password'   => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required|string|min:6',
        ]);


        if ($validation->fails()) {
            return response()->json([
                'status'  => false,
                'message' => 'Validation failed',
                'errors'  => $validation->errors()
            ]);
        } else {

            $role = Role::where('slug', 'admin')->first();

            if (!$role) {
                $role = new Role();
                $role->name = 'Admin';
                $role->slug = 'admin';
                $role->save();
            }

            // Create user
            $user = new User();
            $user->name = $request->first_name . ' '  . $request->last_name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->save();

            // Attach role
            $user->roles()->attach($role->id);


            return response()->json([
                'status' => true,
                'message' => 'Signup successful'
            ]);
        }
    }






    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('admin.login')->with('success', 'Logged out successfully.');
    }



    // public function createAdmin()
    // {
    //     $role = Role::where('slug', 'user')->first();

    //     if (!$role) {
    //         $role = new Role();
    //         $role->name = 'User';
    //         $role->slug = 'user';
    //         $role->save();
    //     }

    //     // Create user
    //     $user = new User();
    //     $user->name = "User";
    //     $user->email = "user@gmail.com";
    //     $user->password = Hash::make('123456');
    //     $user->save();

    //     // Attach role
    //     $user->roles()->attach($role->id);
    // }
}
