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
use App\Models\AttributeValue;
use App\Models\ProductAttribute;
use App\Models\ProductVariant;


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




        // "category_id" => "1"
        //   "attribute_value_id" => array:3 [
        //     0 => "107"
        //     1 => "224"
        //     2 => "226"
        //   ]


        //   "keywords" => "Keywords , Keywords,Keywords"




        $rules = [
            'name'          => 'required|string|max:255',
            'slug'          => 'required|string|max:255|unique:products,slug',
            'description'   => 'nullable|string',
            'keywords' => [
                'nullable',
                'string',
                'max:255',
                'regex:/^[A-Za-z\s,]+$/'
            ],

            'feature_image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:5124',
            'category_id'   => 'nullable|exists:categories,id',
            'attribute_value_id'   => 'nullable|exists:attribute_values,id',
            'brand_id'      => 'nullable|exists:brands,id',
            'status'        => 'required|in:enabled,disabled',
            'product_type'  => 'required|in:simple,variable',
        ];

        if ($request->product_type === 'simple') {
            $rules = array_merge($rules, [
                'regular_price' => 'required|numeric|min:0',
                'sale_price'    => 'nullable|numeric|min:0|lt:regular_price',
                'sku'           => 'required|string|max:100|unique:product_simples,sku',
                'stock_status'  => 'required|in:in_stock,out_of_stock',
                'quantity'      => 'nullable|integer',
                'weight'        => 'nullable|numeric|min:0',
                'length'        => 'nullable|numeric|min:0',
                'width'         => 'nullable|numeric|min:0',
                'height'        => 'nullable|numeric|min:0',
            ]);
        }

        $request->validate($rules);

        if ($request->filled('keywords')) {

            $key_array = explode(',', $request->keywords);

            $key_trim = array_map('trim', $key_array);

            $keywords = json_encode($key_trim);
        } else {
            $keywords = null;
        }



        DB::beginTransaction();
        try {
            $feature_image = $this->handleImageUpload(
                $request,
                'feature_image',
                'admin/assets/images/products/',
                new Product,
                'product_feature'
            );

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
                'keywords'      => $keywords,
            ]);

            // Save simple product details
            if ($product->product_type === 'simple') {
                ProductSimple::create([
                    'product_id'    => $product->id,
                    'regular_price' => $request->regular_price,
                    'sale_price'    => $request->sale_price,
                    'sku'           => $request->sku,
                    'quantity'      => $request->quantity ?? 0,
                    'stock_status'  => $request->stock_status,
                    'weight'        => $request->weight,
                    'length'        => $request->length,
                    'width'         => $request->width,
                    'height'        => $request->height,
                ]);

                ProductVariant::where('product_id' , $product->id )->delete();
            }

            // Save attribute_value
            if (!empty($product->category_id)) {

                if (!empty($request->attribute_value_id) && is_array($request->attribute_value_id)) {

                    foreach ($request->attribute_value_id as $val) {

                        $attributeValue = AttributeValue::find($val);

                        if ($attributeValue) {
                            $attributeId = $attributeValue->attribute_id;

                            ProductAttribute::create([
                                'product_id'         => $product->id,
                                'attribute_id'       => $attributeId,
                                'attribute_value_id' => $val,
                            ]);
                        }
                    }
                }
            }

            DB::commit();

            return $this->success(['redirect_url' => route('admin.product.edit', $product->id)], 'Product Created Successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->error([], 'Something went wrong!', 404);
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
