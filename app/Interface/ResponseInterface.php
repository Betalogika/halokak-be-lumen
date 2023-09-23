<?php

namespace App\Interface;


interface ResponseInterface
{
    public function ok($data, int $statusCode = 200, String $message = 'Successfully Data');
    public function error(int $statusCode = 422, String $message = 'Errors Data');
    public function customError($data);
}
