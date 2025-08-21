<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\CategoryAttribute;
use App\Models\Product;
use App\Traits\ApiResponseTrait;
use App\Traits\ImageUploadTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{

    use ApiResponseTrait;
    use ImageUploadTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $products = Product::paginate();
        return view('admin.pages.products.product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $categories = Category::get();
        $brands = Brand::get();



        return view('admin.pages.products.product.create', compact('categories', 'brands'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'name'       => 'required|string|max:255',
            'slug'       => 'required|string|max:255|unique:products,slug',
            'description' => 'nullable|string',
            // 'mrp'        => 'nullable|numeric',
            // 'price'      => 'nullable|numeric',
            // 'sku'        => 'nullable|string|max:100',
            // 'qty'        => 'nullable|integer|min:0',
            // 'weight'     => 'nullable|numeric',
            // 'length'     => 'nullable|numeric',
            // 'width'      => 'nullable|numeric',
            // 'height'     => 'nullable|numeric',
            'keywords'   => 'nullable|string',
            'new_image'  => 'nullable|image|mimes:jpg,jpeg,png,gif|max:5124',
        ];

        $validation = Validator::make($request->all(), $rules);

        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation)->withInput();
        }

        $fieldName = 'new_image';
        $imagePath = 'admin/assets/images/products/';
        $model = new Product;
        $prefix = 'product_feature';

        $image = $this->handleImageUpload($request, $fieldName, $imagePath, $model, $prefix);

        $model->name        = $request->name;
        $model->slug        = $request->slug;
        $model->image       = $image;
        $model->description = $request->description;
        $model->keywords    = $request->keywords;

        // uncomment as needed
        // $model->mrp    = $request->mrp;
        // $model->price  = $request->price;
        // $model->sku    = $request->sku;
        // $model->qty    = $request->qty;
        // $model->weight = $request->weight;
        // $model->length = $request->length;
        // $model->width  = $request->width;
        // $model->height = $request->height;

        $model->save();

        return redirect()->route('admin.product.edit', $model->id)
            ->with('success', 'Product created successfully!');
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
        $product = Product::findOrfail($id);

        return view('admin.pages.products.product.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id) {}

    /**
     * Remove the specified resource from storage.
     */
    public function getAttribute(Request $request)
    {
        $cat_id = $request->category_id;

        $data = CategoryAttribute::where('category_id', $cat_id)->with('attribute.values')->get();

        dd($data);
    }
}
