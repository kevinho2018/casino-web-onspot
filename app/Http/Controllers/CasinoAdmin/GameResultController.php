<?php
/**
 * Created by PhpStorm.
 * User: kevin
 * Date: 2018/8/28
 * Time: 上午11:33
 */

namespace App\Http\Controllers\CasinoAdmin;

use Carbon\Carbon;
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
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function searchResult(Request $request)
    {
        Voyager::canOrFail('browse_admin');

        $gameReport = null;

        return view('CasinoAdmin.gameResult', compact('gameReport'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Support\Collection
     */
    public function getGameResult(Request $request)
    {
        $status = $request->get('search-ModifiedStatus');
        $searchStartTime = ($request->get('startAt') == null) ? Carbon::now()->startOfDay()->subDay()->toDateTimeString() : $request->get('startAt');
        $searchEndTime = ($request->get('endAt') == null) ? Carbon::now()->endOfDay()->toDateTimeString() : $request->get('endAt');

        $gameReport = $this->baccaratService->getGameReport($searchStartTime, $searchEndTime, $status)->toArray();

        return view('CasinoAdmin.gameResult', compact('gameReport'));
    }
}
