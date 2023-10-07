<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;

use App\Interface\ResponseInterface;
use App\Models\verifyAccount;
use App\Models\forgotPasswords;

class Controller extends BaseController implements ResponseInterface
{
    public function ok($data, string $message = 'Successfully Data', int $statusCode = 200)
    {
        return response()->json(['message' => $message, 'data' => $data], $statusCode);
    }

    public function error(string $message = 'Errors Data', int $statusCode = 422, String $data = '')
    {
        return response()->json(['message' => $message, 'data' => $data], $statusCode);
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

    public function urlForgot(forgotPasswords $url)
    {
        return config('url.halokak_dev') . '/auth/forgot/' . $url->token . '/password';
    }

    public function urlVerify(verifyAccount $url)
    {
        return config('url.halokak_dev') . '/auth/verify/' . $url->token . '/account';
    }
}
