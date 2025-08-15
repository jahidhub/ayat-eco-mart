<?php

namespace App\Http\Controllers\Admin;

use App\Models\Attribute;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\AttributeValue;
use App\Traits\ApiResponseTrait;

class AttributeController extends Controller
{
    use ApiResponseTrait;
    /**
     * Display a listing of the resource.
     */
    public function attributes_index()
    {

        $attributes = Attribute::paginate();
        return view('admin.pages.products.attribute.attribute', compact('attributes'));
    }

    public function attributes_store(Request $request)
    {
        // dd($request->all());

        if ($request->id > 0) {
            $request->validate([
                "name" => "required|string|max:255",
                "slug" => "nullable|string|max:255"
            ]);
        } else if ($request->id == 0) {
            $request->validate([
                "name" => "required|string|max:255|unique:attributes,name",
                "slug" => "nullable|string|max:255|unique:attributes,slug"
            ]);
        }



        Attribute::updateOrCreate(
            ['id' => $request->id],
            [
                "name" => $request->name,
                "slug" => $request->slug ??  Str::slug($request->name),

            ]
        );

        return $this->success(['reload' => true], 'Attribute saved successfully!');
    }


    // attribute_values

    public function attribute_values_index()
    {

        $attribute_values = AttributeValue::with('attribute')->paginate();

        // dd($attribute_values);

        $attributes = Attribute::get();

        return view('admin.pages.products.attribute.attribute-value', compact('attribute_values', 'attributes'));
    }

    public function attribute_values_store(Request $request)
    {

        $rules = [
            "attr_id" => "required|integer",
            "value" => "required|string|max:255|unique:attribute_values,attribute_value"
        ];

        if ($request->id > 0) {
            $rules["attr_id"] = "nullable|integer";
            $rules["value"] = "nullable|string|max:255";
        }

        $request->validate($rules);

        AttributeValue::updateOrCreate(
            ['id' => $request->id],
            [
                "attribute_id"    => $request->attr_id,
                "attribute_value" => $request->value,
            ]
        );


        return $this->success(['reload' => true], 'Attribute value saved successfully!');
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
