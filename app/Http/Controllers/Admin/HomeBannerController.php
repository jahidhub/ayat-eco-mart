<?php

namespace App\Http\Controllers\Admin;

use App\Models\HomeBanner;
use Illuminate\Http\Request;
use App\Traits\ApiResponseTrait;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Validator;

class HomeBannerController extends Controller
{

    use ApiResponseTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $data = HomeBanner::get();

        return view('admin.pages.homeBanner.home-banner', compact('data'));
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


        // dd($request->all());
        $validation = Validator::make($request->all(), [

            'content'   => 'required|string',
            'link'      => 'nullable|string',
            'new_image' => $request->id
                ? 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048'
                : 'required|image|mimes:jpg,jpeg,png,webp|max:2048',


        ]);

        if ($validation->fails()) {
            return $this->error([], $validation->errors()->first(), 422);
        }

        $db_image_path = null;
        $image_save_path = "admin/assets/images/banner/";

        // If image is uploaded
        if ($request->hasFile('new_image')) {

            $main_image = $request->file('new_image');

            // Delete old image if updating
            if ($request->id > 0) {
                $image_db = HomeBanner::find($request->id);
                if ($image_db && $image_db->image) {
                    $image_path = public_path($image_save_path . $image_db->image);
                    if (File::exists($image_path)) {
                        File::delete($image_path);
                    }
                }
            }

            // Save new image
            $image_name = 'banner-' . time() . '.' . $main_image->extension();
            $db_image_path = $image_save_path . $image_name;
            $main_image->move(public_path($image_save_path), $image_name);
        } elseif ($request->id > 0) {
            // Keep old image if no new image uploaded
            $db_image_path = HomeBanner::where('id', $request->id)->value('image');
        }




        // Create or Update record
        HomeBanner::updateOrCreate(
            ['id' => $request->id],
            [
                'content' => $request->content,
                'link'    => $request->link,
                'image'   => $db_image_path,
            ]
        );

        return $this->success(['reload' => true], 'Banner saved successfully');
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
