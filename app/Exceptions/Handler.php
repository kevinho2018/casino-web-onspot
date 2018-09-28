<?php

namespace App\Exceptions;

use Carbon\Carbon;
use DB;
use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * @param Exception $exception
     * @return mixed|void
     * @throws Exception
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        if ($exception instanceof NotFoundHttpException) {
            return response()->view('errors.404');
        }

        // 如果是casino-api的request
        if ($request->is('casino-api/*'))
        {
            return $this->handlerApi($request, $exception);
        }

        return parent::render($request, $exception);
    }

    /**
     * @param $request
     * @param $exception
     * @return \Illuminate\Http\JsonResponse
     */
    private function handlerApi($request, $exception)
    {
        $errorJson = [
            'status' => 'error',
            'error' => [
                'code' => '10',
                'message' => 'service not available'
            ]
        ];

        if ($exception instanceof ApiErrorException) {
            $errorJson['error'] = $exception->toArray();
        }

        if ($exception instanceof MethodNotAllowedHttpException) {
            $error = config('Api.errors.method_not_allowed');
            $errorJson['error']['code'] = $error['code'];
            $errorJson['error']['message'] = vsprintf($error['message'], $request->method());
        }

        $headers = ['Content-Type' => 'application/json; charset=utf-8'];

        DB::table('ApiCallRecord')->insert([
            'Status' => 'failed',
            'Ip' => $request->ip(),
            'RequestMethod' => $request->method(),
            'RequestContent' => json_encode($request->all(), JSON_UNESCAPED_UNICODE),
            'RequestUrl' => $request->url(),
            'RequestApi' => $request->path(),
            'ResponseContent' => json_encode($errorJson),
            'RequestTime' => Carbon::now(),
        ]);

        return response()->json($errorJson, 200, $headers, JSON_UNESCAPED_UNICODE);
    }
}
