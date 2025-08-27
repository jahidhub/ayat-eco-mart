<?php

namespace App\Http\Controllers\Admin;

use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\ProductSimple;
use App\Traits\ApiResponseTrait;
use App\Traits\ImageUploadTrait;
use App\Models\CategoryAttribute;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log as FacadesLog;

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


        // dd($request->all());


        $rules = [
            'name'          => 'required|string|max:255',
            'slug'          => 'required|string|max:255|unique:products,slug',
            'description'   => 'nullable|string',
            'keywords'      => 'nullable|string|max:255',
            'feature_image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:5124',
            'category_id'   => 'nullable|exists:categories,id',
            'brand_id'      => 'nullable|exists:brands,id',
            'status'        => 'required|in:enabled,disabled',
            'product_type'  => 'required|in:simple,variable',

            // simple product rules
            'regular_price' => 'nullable|numeric|min:0',
            'sale_price'    => 'nullable|numeric|min:0',
            'sku'           => 'nullable|string|max:100|unique:product_simples,sku',
            'stock_status'  => 'required|in:in_stock,out_of_stock',
            'quantity'      => 'nullable|integer|min:0',
            'weight'        => 'nullable|numeric|min:0',
            'length'        => 'nullable|numeric|min:0',
            'width'         => 'nullable|numeric|min:0',
            'height'        => 'nullable|numeric|min:0',
        ];

        $validation = Validator::make($request->all(), $rules);

        if ($validation->fails()) {
            return redirect()->back()->with('error', 'Something went wrong !')->withErrors($validation)->withInput();
        }

        DB::beginTransaction();

        try {



            $fieldName = 'feature_image';
            $imagePath =  'admin/assets/images/products/';
            $model = new Product;
            $prefix = 'product_feature';
            $feature_image = $this->handleImageUpload($request, $fieldName, $imagePath, $model, $prefix);


            // Save Product
            $product = Product::create([
                'name'          => $request->name,
                'slug'          => $request->slug,
                'feature_image' => $feature_image,
                'description'   => $request->description,
                'product_type'  => $request->product_type,
                'category_id'   => $request->category_id,
                'brand_id'      => $request->brand_id,
                'status'        => $request->status,
                'keywords'      => $request->keywords,
            ]);

            // If product type is simple, save in ProductSimple
            if ($product->product_type === 'simple') {
                ProductSimple::create([
                    'product_id'    => $product->id,
                    'regular_price' => $request->regular_price,
                    'sale_price'    => $request->sale_price,
                    'sku'           => $request->sku,
                    'quantity'      => $request->quantity,
                    'stock_status'  => $request->stock_status,
                    'weight'        => $request->weight,
                    'length'        => $request->length,
                    'width'         => $request->width,
                    'height'        => $request->height,
                ]);
            }

            DB::commit();

            return redirect()->route('admin.product.edit', $product->id)
                ->with('success', 'Product created successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Something went wrong: ' . $e->getMessage())->withInput();
        }
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
        $request->validate([
            'category_id' => 'required|exists:categories,id'
        ]);

        $categoryId = $request->category_id;

        $catAttrs = CategoryAttribute::where('category_id', $categoryId)
            ->with('attribute.values')
            ->get();

        if ($catAttrs->isEmpty()) {
            return $this->error([], 'No attributes found', 404);
        }

        return $this->success(
            ['attributes' => $catAttrs],
            'Category attributes retrieved successfully'
        );
    }
}
