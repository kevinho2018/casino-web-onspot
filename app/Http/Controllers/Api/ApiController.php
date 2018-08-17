<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ApiController extends Controller
{

    /**
     * @param string $method
     * @param array $parameters
     * @return \Illuminate\Http\JsonResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function callAction($method, $parameters)
    {
        $response = parent::callAction($method, $parameters);

        if (! is_array($response)) {
            return $response;
        }

        $responseJson = [
            'status' => 'success',
            'data' => $response
        ];

        $headers = ['Content-Type' => 'application/json; charset=utf-8'];

        return response()->json($responseJson, 200, $headers, JSON_UNESCAPED_UNICODE);
    }
}
