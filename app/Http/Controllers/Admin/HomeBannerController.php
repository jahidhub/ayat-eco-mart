<?php

namespace App\Http\Controllers\Admin;

use App\Models\HomeBanner;
use Illuminate\Http\Request;
use App\Traits\ApiResponseTrait;
use App\Http\Controllers\Controller;
use App\Traits\ImageUploadTrait;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Validator;

class HomeBannerController extends Controller
{

    use ApiResponseTrait;
    use ImageUploadTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $data = HomeBanner::latest()->paginate(10);

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
            'link'      => 'nullable|string|url',
            'new_image' => $request->id > 0
                ? 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048'
                : 'required|image|mimes:jpg,jpeg,png,webp|max:2048',


        ]);

        if ($validation->fails()) {
            return $this->error([], $validation->errors()->first(), 422);
        }

        $fieldName = 'new_image';
        $imagePath =  'admin/assets/images/banner/';
        $model = new HomeBanner;
        $prefix = 'banner';
        $image = $this->handleImageUpload($request, $fieldName, $imagePath, $model, $prefix);


        // Create or Update record
        HomeBanner::updateOrCreate(
            ['id' => $request->id],
            [
                'content' => $request->content,
                'link'    => $request->link,
                'image'   => $image,
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
