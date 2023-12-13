<?php

namespace App\Interface;


interface ResponseInterface
{
    public function ok($data, String $message = 'Successfully Data', int $statusCode = 200);
    public function error(String $message = 'Errors Data', int $statusCode = 422);
    public function customError($data);
}
