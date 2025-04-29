<?php

namespace backend\helpers;

class ResponseHelper
{
    public static function success($data, $code = 200)
    {
        http_response_code($code);
        header('Content-Type: application/json');
        echo json_encode($data);
    }

    public static function error($message, $code = 400)
    {
        http_response_code($code);
        header('Content-Type: application/json');
        echo json_encode(["error" => $message]);
    }

    public static function notAllowed()
    {
        http_response_code(405);
        header('Content-Type: application/json');
        echo json_encode(["error" => "Metodo não permitido"]);
    }
}
