<?php
/**
 * Created by PhpStorm.
 * User: kevin
 * Date: 2018/8/28
 * Time: 上午11:33
 */

namespace App\Http\Controllers\CasinoAdmin;

use TCG\Voyager\Http\Controllers\VoyagerBaseController;
use Illuminate\Http\Request;
use TCG\Voyager\Facades\Voyager;
use App\Services\Api\BaccaratService;

/**
 * Class GameResultController
 * @property BaccaratService baccaratService
 * @package App\Http\Controllers\CasinoAdmin
 */
class GameResultController extends VoyagerBaseController
{
    public function __construct(
        BaccaratService $baccaratService
    ) {
        $this->baccaratService = $baccaratService;
    }
    /**
     * @param Request $request
     * @return int
     */
    public function searchResult(Request $request)
    {
        Voyager::canOrFail('browse_admin');

        return view('casinoAdmin.gameResult');
    }

    public function getGameResult(Request $request)
    {
        $searchStartTime = $request->get('startTime');
        $searchEndTime = $request->get('EndTime');
        $status = $request->get('status');

        return $this->baccaratService->getGameReport($searchStartTime, $searchEndTime, $status);
    }


}