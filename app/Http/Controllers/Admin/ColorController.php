<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Color;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;

class ColorController extends Controller
{
    use ApiResponseTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $colors = Color::orderBy('id', 'ASC')->paginate(10);
        return view('admin.pages.products.color.color',  compact('colors'));
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

        $request->validate([
            "name" => "required|string",
            "color_code" => [
                "required",
                "regex:/^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/"
            ],
        ]);

        Color::updateOrCreate(
            ['id' => $request->id],
            [
                "name" => $request->name,
                "code" => $request->color_code

            ]
        );

        return $this->success(['reload' => true], 'Color saved successfully!');
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
