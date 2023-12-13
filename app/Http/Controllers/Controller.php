<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;

use App\Models\verifyAccount;
use App\Models\forgotPasswords;
use App\Interface\ResponseInterface;
use Illuminate\Support\Facades\Storage;
use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController implements ResponseInterface
{
    public function ok($data, string $message = 'Successfully Data', int $statusCode = 200)
    {
        return response()->json(['message' => $message, 'data' => $data], $statusCode);
    }

    public function error(string $message = 'Errors Data', int $statusCode = 422)
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

    public function urlForgot(forgotPasswords $url)
    {
        return config('url.halokak_verify_forgot') . '/auth/forgot/' . $url->token . '/password';
    }

    public function urlVerify(verifyAccount $url)
    {
        return config('url.halokak_verify_forgot') . '/auth/verify/' . $url->token . '/account';
    }

    public function urlLogin()
    {
        return config('url.halokak_dev');
    }

    public function uploadBase64($image, $prefix = '/')
    {
        $slug = time() . Str::random(16); //name prefix
        $avatar = $this->getFileName($image, $slug);
        Storage::disk('sftp')->put($prefix . $avatar['name'],  base64_decode($avatar['file']), 'images');
        $url = config('filesystems.disks.sftp.prefix') . $prefix . $avatar['name'];
        return $url;
    }

    public function imageToUrl($file, $prefix = 'files/')
    {
        if (substr($file, 0, 8) === "https://" || substr($file, 0, 7) === "http://") {
            return $file;
        } else {
            return $this->uploadBase64($file, $prefix);
        }
    }

    public function getFileName($image, $namePrefix)
    {
        list($type, $file) = explode(';', $image);
        list(, $extension) = explode('/', $type);
        list(, $file) = explode(',', $file);
        $result['name'] = $namePrefix . '.' . $extension;
        $result['file'] = $file;
        return $result;
    }

    public function pagination($request)
    {
        $limit = 20;
        if ($limit >= $request->limit) {
            $limit = $request->limit;
        }

        return $limit;
    }
}
