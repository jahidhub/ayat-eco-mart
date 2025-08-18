<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\ApiResponseTrait;

class CategoryController extends Controller
{
    use ApiResponseTrait;
    /**
     * Display a listing of the resource.
     */
    public function category_index()
    {

        $categories = Category::with('parent')->paginate();

        // dd($categories);

        return view('admin.pages.products.category.category', compact('categories'));
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
    public function category_store(Request $request)
    {

        $rules = [
            'name'       => 'required|string|max:255',
            'slug'       => 'required|string|max:255|unique:categories,slug',
            'parent_cat' => 'nullable|exists:categories,id',
            'image'      => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5125',
        ];


        if ($request->id > 0) {
            $rules['name'] = 'nullable|string|max:255';
            $rules['slug'] = 'nullable|string|max:255';
        }

        $request->validate($rules);


        $image_path = 'admin/assets/images/categories/';
        $image_db = null;

        if ($request->hasFile('image')) {
            $main_image =  $request->file('image');
            $image_name = time() . '.' . $main_image->extension();
            // db save
            $image_db = $image_path . $image_name;
            // public save
            $main_image->move(public_path($image_path), $image_name);
        }



        Category::updateOrCreate(
            ['id' => $request->id],
            [
                "name"    => $request->name,
                "slug" => $request->slug ?? Str::slug($request->name),
                "parent_category_id" => $request->parent_cat,
                "image" => $image_db,
            ]
        );

        return $this->success(['reload' => false], 'Category saved successfully',);
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        //
    }
}
