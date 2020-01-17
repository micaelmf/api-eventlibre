<?php 

namespace App\api;

class ApiError
{
    public static function errorMessage($message, $code)
    {
        return [
            'data' => $message,
            'code' => $code,
        ];
    }   
}