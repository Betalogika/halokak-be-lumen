<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;

use App\Interface\ResponseInterface;

class Controller extends BaseController implements ResponseInterface
{
    public function ok($data, int $statusCode = 200, string $message = 'Successfully Data')
    {
        return response()->json(['message' => $message, 'data' => $data], $statusCode);
    }

    public function error(int $statusCode = 422, string $message = 'Errors Data')
    {
        return response()->json(['message' => $message], $statusCode);
    }

    public function customError($data)
    {
        $data = collect($data);
        $res = collect([]);

        foreach ($data as $key => $value) {
            $data = array(
                'request' => $key,
                'message' => $value[0],
            );

            $res->push($data);
        }

        return response()->json(['message' => 'Data tidak lengkap', 'data' => $res], 422);
    }
}
