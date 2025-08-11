<?php

namespace App\Traits;

trait ApiResponseTrait
{

    /**
     * @param string $message
     * @param string|array  $data
     * @param int|null $code
     * @return \illuminate\Http\JsonResponse
     */

    protected function success($data, string $message = null, int $code = 200)
    {

        return response()->json([
            'status' => true,
            'message' => $message,
            'data' => $data
        ], $code);
    }
    protected function error($data, string $message = null, int $code)
    {

        return response()->json([
            'status' => false,
            'message' => $message,
            'data' => $data
        ], $code);
    }
}
