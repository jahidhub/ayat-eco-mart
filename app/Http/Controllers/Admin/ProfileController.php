<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\ApiResponseTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{

    use ApiResponseTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        return view('admin.pages.profile');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'full_name' => 'required|string|max:255',
            // 'email' => 'required|email|max:255|unique:users,email,' . Auth::id(),
            'old_password' => 'nullable|string|min:6',
            'new_password' => 'nullable|string|min:6|different:old_password',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'social_links.facebook' => 'nullable|url|max:255',
            'social_links.twitter' => 'nullable|url|max:255',
            'profile_img' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validation->fails()) {
            return $this->error([], $validation->errors()->first(), 422);
        }

        $user = Auth::user();

        // Handle social links
        $social_links = json_decode($user->social_links, true) ?? [];
        if ($request->has('social_links')) {
            $social_links = array_merge($social_links, $request->input('social_links'));
        }

        // Handle password update
        $password = $user->password;

        if ($request->filled('old_password')) {
            if (!Hash::check($request->old_password, $user->password)) {
                return $this->error([], 'Old password does not match.', 422);
            }
            if (!$request->filled('new_password')) {
                return $this->error([], 'New password must be provided.', 422);
            }
        }

        if ($request->filled('new_password')) {
            // Check if old password is provided
            if (!$request->filled('old_password')) {
                return $this->error([], 'Old password must be provided to set a new password.', 422);
            }

            // Check if old password matches
            if (!Hash::check($request->old_password, $user->password)) {
                return $this->error([], 'Old password does not match.', 422);
            }
            $password = Hash::make($request->new_password);
        }



        // Handle profile image
        $profile_image = $user->profile_img;
        if ($request->hasFile('profile_img')) {
            if ($profile_image && file_exists(public_path($profile_image))) {
                @unlink(public_path($profile_image));
            }
            $file = $request->file('profile_img');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('admin/assets/images/profile'), $filename);
            $profile_image = 'admin/assets/images/profile/' . $filename;
        }

        // Update user
        User::updateOrCreate(
            ['id' => $user->id],
            [
                'name'         => $request->full_name,
                // 'email'        => $request->email,
                'phone'        => $request->phone,
                'address'      => $request->address,
                'password'     => $password,
                'social_links' => json_encode($social_links),
                'profile_img'  => $profile_image,
            ]
        );

        $message = 'Profile updated successfully';

        return $this->success(['reload' => true], $message);
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
