<?php

namespace App\Traits;

use Illuminate\Support\Facades\File;

trait ImageUploadTrait
{
    /**
     * Handle image upload, update, and delete old image
     *
     * @param \Illuminate\Http\Request $request
     * @param string $fieldName - input file field name
     * @param string $imagePath - folder path where image will be stored
     * @param object $model - Model class (e.g., new Category)
     * @param string $prefix
     * @return string|null
     */
    public function handleImageUpload($request, $fieldName, $imagePath, $model = null, $prefix = null)
    {

        // use ImageUploadTrait;

        // $fieldName = 'new_image';
        // $imagePath =  'admin/assets/images/categories/';
        // $model = new Category;
        // $prefix = 'cat';
        // $image = $this->handleImageUpload($request, $fieldName, $imagePath, $model, $prefix);




        $dbImagePath = null;

        if ($request->hasFile($fieldName)) {
            $mainImage = $request->file($fieldName);

            // Delete old image if updating
            if ($request->id > 0) {
                $imageDb = $model::find($request->id);
                if ($imageDb && $imageDb->image) {
                    $image_path = public_path($imageDb->image);

                    if (File::exists($image_path)) {
                        File::delete($image_path);
                    }
                }
            }

            // Save new image
            $imageName = $prefix . time() . '.' . $mainImage->extension();
            $dbImagePath = $imagePath . $imageName;
            $mainImage->move(public_path($imagePath), $imageName);
        } elseif ($request->id > 0) {
            // Keep old image if no new image uploaded
            $dbImagePath = $model::where('id', $request->id)->value('image');
        }

        return $dbImagePath;
    }
}
