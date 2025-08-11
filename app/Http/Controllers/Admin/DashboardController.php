<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    use ApiResponseTrait;
    public function showDashboard()
    {
        return view('admin.pages.dashboard');
    }

    public function delete($id = '', $table = '')
    {
        // Fetch the record
        $db_data = DB::table($table)->where('id', $id)->first();

        if (!$db_data) {
            return $this->error([], 'Record not found', 404);
        }

        if (!empty($db_data->image)) {
            $file_image_path = public_path($db_data->image);
            if (file_exists($file_image_path)) {
                unlink($file_image_path);
            }
        }

        // Delete the record from the database
        DB::table($table)->where('id', $id)->delete();

        return $this->success(['reload' => true], 'Data deleted successfully!');
    }
}
