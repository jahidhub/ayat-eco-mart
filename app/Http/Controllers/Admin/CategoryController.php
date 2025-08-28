<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Models\Attribute;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\AttributeValue;
use App\Models\CategoryAttribute;
use App\Traits\ApiResponseTrait;
use App\Traits\ImageUploadTrait;
use Illuminate\Support\Facades\File;

class CategoryController extends Controller
{
    use ApiResponseTrait;
    use ImageUploadTrait;
    /**
     * Display a listing of the resource.
     */
    public function category_index()
    {

        $categories = Category::with('parent')->paginate(5);

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
            'new_image'      => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5125',
        ];


        if ($request->id > 0) {
            $rules['name'] = 'required|string|max:255';
            $rules['slug'] = 'required|string|max:255|unique:categories,slug,' . $request->id;
        }

        $request->validate($rules);


        // here use ImageUploadTrait 

        $fieldName = 'new_image';
        $imagePath =  'admin/assets/images/categories/';
        $model = new Category;
        $prefix = 'cat';
        $image = $this->handleImageUpload($request, $fieldName, $imagePath, $model, $prefix);



        Category::updateOrCreate(
            ['id' => $request->id],
            [
                "name"    => $request->name,
                "slug" => $request->slug ?? Str::slug($request->name),
                "parent_category_id" => $request->parent_cat,
                "image" => $image,
            ]
        );

        return $this->success(['reload' => true], 'Category saved successfully',);
    }

    /**
     * Display the specified resource.
     */
    public function index_category_attribute()
    {
        $items = CategoryAttribute::with('category', 'attribute', 'attribute_values')->latest()->paginate();
        // echo '<pre>';
        // print_r($items->toArray());
        // echo '</pre>';
        $categories = Category::get();
        $attributes = Attribute::get();

        return view('admin.pages.products.category.category-attribute', compact('items', 'categories', 'attributes'));
    }
    
    public function store_category_attribute(Request $request)
    {

        // dd($request->all());

        $rules = [
            'category_id'  => 'required|exists:categories,id',
            'attribute_id' => 'required|exists:attributes,id',
        ];


        $request->validate($rules);


        CategoryAttribute::updateOrCreate(
            ['id' => $request->id],
            [
                "category_id"    => $request->category_id,
                "attribute_id" => $request->attribute_id,
            ]
        );

        return $this->success(['reload' => true], 'Category & Attribute saved successfully',);
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
