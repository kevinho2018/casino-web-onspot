<?php
/**
 * Created by PhpStorm.
 * User: kevin
 * Date: 2018/8/7
 * Time: 下午5:08
 */

namespace App\Repositories;


use App\Models\BaccaratHistory\BaccaratHistory;
use Carbon\Carbon;
use App\Services\Game\CountGameResultService;
use Illuminate\Http\Request;

/**
 * Class BaccaratRepository
 * @property CountGameResultService countGameResultService

 * @package App\Repositories
 */
class BaccaratRepository
{
    /**
     * @var BaccaratHistory
     */
    protected $baccaratHistory;

    /**
     * BaccaratRepository constructor.
     * @param BaccaratHistory $baccaratHistory
     * @param CountGameResultService $countGameResultService
     */
    public function __construct(
        BaccaratHistory $baccaratHistory,
        CountGameResultService $countGameResultService
    ) {
        $this->baccaratHistory = $baccaratHistory;
        $this->countGameResultService = $countGameResultService;
    }

    /**
     * 取得歷史牌局紀錄
     * @param $searchStartTime
     * @param $searchEndTime
     * @param $status
     * @return \Illuminate\Support\Collection
     */
    public function getBaccaratHistoryReport($searchStartTime, $searchEndTime, $status)
    {
        return $this->baccaratHistory
            ->where('ModifiedTime', '>=', $searchStartTime)
            ->where('ModifiedTime', '<=', $searchEndTime)
            ->where('ModifiedStatus', '=', $status)
            ->get();
    }

    /**
     * 查詢桌號、輪號、有狀態的歷史牌局紀錄
     * @param Request $request
     * @param $searchStartTime
     * @param $searchEndTime
     * @return $this|\Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getReportWithTableRoundStatus(Request $request, $searchStartTime, $searchEndTime)
    {
        return $this->baccaratHistory
                ->where('TableId', '=', $request->get('search-TableId'))
                ->where('Round', '=', $request->get('search-GameRound'))
                ->where('ModifiedTime', '>=', $searchStartTime)
                ->where('ModifiedTime', '<=', $searchEndTime)
                ->where('ModifiedStatus', '=', $request->get('search-ModifiedStatus'))
                ->get();
    }

    /**
     * 查詢桌號、輪號、不限狀態的歷史牌局紀錄
     * @param Request $request
     * @param $searchStartTime
     * @param $searchEndTime
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getReportWithTableRound(Request $request, $searchStartTime, $searchEndTime)
    {
        return $this->baccaratHistory
            ->where('TableId', '=', $request->get('search-TableId'))
            ->where('Round', '=', $request->get('search-GameRound'))
            ->where('ModifiedTime', '>=', $searchStartTime)
            ->where('ModifiedTime', '<=', $searchEndTime)
            ->get();
    }

    /**
     * 查詢桌號、無輪號、不限狀態的歷史牌局紀錄
     * @param Request $request
     * @param $searchStartTime
     * @param $searchEndTime
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getReportWithTable(Request $request, $searchStartTime, $searchEndTime)
    {
        return $this->baccaratHistory
            ->where('TableId', '=', $request->get('search-TableId'))
            ->where('ModifiedTime', '>=', $searchStartTime)
            ->where('ModifiedTime', '<=', $searchEndTime)
            ->get();
    }

    /**
     * 查詢桌號、無輪號、有狀態的歷史牌局紀錄
     * @param Request $request
     * @param $searchStartTime
     * @param $searchEndTime
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getReportWithTableStatus(Request $request, $searchStartTime, $searchEndTime)
    {
        return $this->baccaratHistory
            ->where('TableId', '=', $request->get('search-TableId'))
            ->where('ModifiedTime', '>=', $searchStartTime)
            ->where('ModifiedTime', '<=', $searchEndTime)
            ->where('ModifiedStatus', '=', $request->get('search-ModifiedStatus'))
            ->get();
    }

    /**
     * 修改歷史牌局紀錄
     * @param $request
     */
    public function modifyBaccaratHistory($request)
    {
        $tableId = $request->get('modify-TableId');
        $round = $request->get('modify-GameRound');
        $run = $request->get('modify-GameRun');

        $Card1 = $request->get('player-card-1');
        $Card2 = $request->get('banker-card-1');
        $Card3 = $request->get('player-card-2');
        $Card4 = $request->get('banker-card-2');
        $Card5 = $request->get('player-card-3');
        $Card6 = $request->get('banker-card-3');
        $ModifiedStatus = $request->get('modify-ModifiedStatus');
        $ModifiedTime = Carbon::now('Asia/Taipei');

        // Count who is Winner
        $this->countGameResultService->StoreGameResult($Card1, $Card2, $Card3, $Card4, $Card5, $Card6);
        $WinSpot = $this->countGameResultService->getWinnerResult();

        $this->baccaratHistory
            ->where('TableId', '=', $tableId)
            ->where('Round', '=', $round)
            ->where('Run', '=', $run)
            ->update([
                'Card1' => $Card1,
                'Card2' => $Card2,
                'Card3' => $Card3,
                'Card4' => $Card4,
                'Card5' => $Card5,
                'Card6' => $Card6,
                'ModifiedStatus' => $ModifiedStatus,
                'ModifiedTime' => $ModifiedTime,
                'WinSpot' => $WinSpot
            ]);
    }

    /**
     * 取消歷史牌局紀錄
     * @param $request
     */
    public function cancelBaccaratHistory($request)
    {
        $tableId = $request->get('cancel-TableId');
        $round = $request->get('cancel-GameRound');
        $run = $request->get('cancel-GameRun');

        $ModifiedStatus = $request->get('cancel-ModifiedStatus');
        $ModifiedTime = Carbon::now('Asia/Taipei');

        $this->baccaratHistory
            ->where('TableId', '=', $tableId)
            ->where('Round', '=', $round)
            ->where('Run', '=', $run)
            ->update([
                'BaccaratHistory.ModifiedStatus' => $ModifiedStatus,
                'BaccaratHistory.ModifiedTime' => $ModifiedTime
            ]);
    }
}
