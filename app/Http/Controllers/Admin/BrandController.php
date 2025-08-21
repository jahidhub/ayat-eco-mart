<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Traits\ApiResponseTrait;
use App\Traits\ImageUploadTrait;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    use ApiResponseTrait;
    use ImageUploadTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $brands = Brand::latest()->paginate();
        return view('admin.pages.products.brand.brand', compact('brands'));
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
        $rules = [
            'name'       => 'required|string|max:255',
            'new_image'  => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5125',
        ];

        $request->validate($rules);


        // here use ImageUploadTrait 

        $fieldName = 'new_image';
        $imagePath =  'admin/assets/images/brands/';
        $model = new Brand;
        $prefix = 'brand';
        $image = $this->handleImageUpload($request, $fieldName, $imagePath, $model, $prefix);



        Brand::updateOrCreate(
            ['id' => $request->id],
            [
                "name"    => $request->name,
                "image" => $image,
            ]
        );

        return $this->success(['reload' => true], 'Brand saved successfully',);
    }
}
