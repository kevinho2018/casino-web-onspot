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
     * @param $request
     */
    public function modifyBaccaratHistory($request)
    {
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
            ->update([
                'BaccaratHistory.Card1' => $Card1,
                'BaccaratHistory.Card2' => $Card2,
                'BaccaratHistory.Card3' => $Card3,
                'BaccaratHistory.Card4' => $Card4,
                'BaccaratHistory.Card5' => $Card5,
                'BaccaratHistory.Card6' => $Card6,
                'BaccaratHistory.$ModifiedStatus' => $ModifiedStatus,
                'BaccaratHistory.$ModifiedTime' => $ModifiedTime,
                'BaccaratHistory.$WinSpot' => $WinSpot
            ]);
    }

    /**
     * @param $request
     */
    public function cancelBaccaratHistory($request)
    {
        $ModifiedStatus = $request->get('modify-ModifiedStatus');
        $ModifiedTime = Carbon::now('Asia/Taipei');

        $this->baccaratHistory
            ->update([
                'BaccaratHistory.$ModifiedStatus' => $ModifiedStatus,
                'BaccaratHistory.$ModifiedTime' => $ModifiedTime
            ]);
    }
}