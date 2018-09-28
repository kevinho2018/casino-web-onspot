<?php

namespace App\Http\Controllers\Api;

use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ApiCallRecord;

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

        $apiRequestInstance = $parameters[0]->instance();

        if ($apiRequestInstance != null && ($apiRequestInstance->is('try/*') || $apiRequestInstance->is('casino-api/*'))
        ) {
            DB::table('ApiCallRecord')->insert(
                [
                    'Status' => 'success',
                    'Ip' => $apiRequestInstance->ip(),
                    'RequestMethod' => $apiRequestInstance->method(),
                    'RequestContent' => json_encode($apiRequestInstance->all(), JSON_UNESCAPED_UNICODE),
                    'RequestUrl' => $apiRequestInstance->url(),
                    'RequestApi' => $apiRequestInstance->path(),
                    'ResponseContent' => json_encode($response),
                    'RequestTime' => Carbon::now(),
                ]
            );
        }

        $headers = ['Content-Type' => 'application/json; charset=utf-8'];

        return response()->json($response, 200, $headers, JSON_UNESCAPED_UNICODE);
    }
}
