<?php
/**
 * Created by PhpStorm.
 * User: kevin
 * Date: 2018/8/7
 * Time: 上午11:20
 */

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Api\BaccaratService;

/**
 * Class BaccaratController
 * @property BaccaratService baccaratService
 * @package App\Http\Controllers\Api
 */
class BaccaratController extends Controller
{
    /**
     * BaccaratController constructor.
     * @param BaccaratService $baccaratService
     */
    public function __construct(
        BaccaratService $baccaratService
    ) {
        $this->baccaratService = $baccaratService;
    }

    /**
     * @param Request $request
     * @return \App\Http\Resources\BaccaratHistoryCollection
     */
    public function getBaccaratHistoryReport(Request $request)
    {
        return $this->baccaratService->getBaccaratHistoryReport($request);
    }
}
