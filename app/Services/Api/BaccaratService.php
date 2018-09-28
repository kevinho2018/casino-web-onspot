<?php
/**
 * Created by PhpStorm.
 * User: kevin
 * Date: 2018/8/7
 * Time: 下午5:00
 */

namespace App\Services\Api;

use App\Http\Resources\BaccaratHistoryResource as BaccaratHistoryResource;
use App\Http\Resources\BaccaratHistoryCollection as BaccaratHistoryCollection;
use App\Repositories\BaccaratRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;

/**
 * @property BaccaratRepository baccaratRepository
 */
class BaccaratService
{
    /**
     * BaccaratService constructor.
     * @param BaccaratRepository $baccaratRepository
     */
    public function __construct(
        BaccaratRepository $baccaratRepository
    ) {
        $this->baccaratRepository = $baccaratRepository;
    }

    /**
     * For Api Response Format
     *
     * @param $input
     * @return BaccaratHistoryCollection|string
     */
    public function getBaccaratHistoryReport($input)
    {
        $searchStartTime = $input['startAt'];
        $searchEndTime = $input['endAt'];
        $status = $input['modifiedStatus'];

        return new BaccaratHistoryCollection(BaccaratHistoryResource::collection($this->getGameReport($searchStartTime,
            $searchEndTime, $status)));
    }

    /**
     * 回傳歷史牌局給外接API
     *
     * @param $searchStartTime
     * @param $searchEndTime
     * @param $status
     * @return \Illuminate\Support\Collection
     */
    public function getGameReport($searchStartTime, $searchEndTime, $status)
    {
        return $this->baccaratRepository->getBaccaratHistoryReport($searchStartTime, $searchEndTime, $status);
    }

    /**
     * @param Request $request
     * @return $this|\Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getGameReportWithParameters(Request $request)
    {
        $searchStartTime = ($request->get('startAt') == null) ? Carbon::now()->startOfDay()->subDay()->toDateTimeString() : $request->get('startAt');
        $searchEndTime = ($request->get('endAt') == null) ? Carbon::now()->endOfDay()->toDateTimeString() : $request->get('endAt');

        if (is_null($request->get('search-GameRound'))) {
            if (is_null($request->get('search-ModifiedStatus'))) {
                // 桌號、無輪號、不限狀態
                return $this->baccaratRepository->getReportWithTable($request, $searchStartTime, $searchEndTime);
            } else {
                // 桌號、無輪號、有狀態
                return $this->baccaratRepository->getReportWithTableStatus($request, $searchStartTime, $searchEndTime);
            }
        } else {
            if (is_null($request->get('search-ModifiedStatus'))) {
                // 桌號、輪號、不限狀態
                return $this->baccaratRepository->getReportWithTableRound($request, $searchStartTime, $searchEndTime);
            } else {
                // 桌號、輪號、有狀態
                return $this->baccaratRepository->getReportWithTableRoundStatus($request, $searchStartTime, $searchEndTime);
            }
        }
    }
}
