<?php
/**
 * Created by PhpStorm.
 * User: kevin
 * Date: 2018/8/7
 * Time: 下午5:08
 */

namespace App\Repositories;

use App\Http\Requests\GameResultCancelRequest;
use App\Http\Requests\GameResultModifyRequest;
use App\Models\BaccaratHistory\BaccaratHistory;
use Carbon\Carbon;

/**
 * Class BaccaratRepository
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
     */
    public function __construct(
        BaccaratHistory $baccaratHistory
    ) {
        $this->baccaratHistory = $baccaratHistory;
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
     * @param $WinSpot
     */
    public function modifyBaccaratHistory(GameResultModifyRequest $request, string $WinSpot)
    {
        $timeNow = Carbon::now('Asia/Taipei');

        $this->baccaratHistory
            ->where('TableId', '=', $request->get('modify-TableId'))
            ->where('Round', '=', $request->get('modify-GameRound'))
            ->where('Run', '=', $request->get('modify-GameRun'))
            ->update([
                'Card1' => $request->get('player-card-1'),
                'Card2' => $request->get('banker-card-1'),
                'Card3' => $request->get('player-card-2'),
                'Card4' => $request->get('banker-card-2'),
                'Card5' => $request->get('player-card-3'),
                'Card6' => $request->get('banker-card-3'),
                'ModifiedStatus' => $request->get('modify-ModifiedStatus'),
                'ModifiedTime' => $timeNow,
                'WinSpot' => $WinSpot
            ]);
    }

    /**
     * @param GameResultCancelRequest $request
     */
    public function cancelBaccaratHistory(GameResultCancelRequest $request)
    {
        $timeNow = Carbon::now('Asia/Taipei');

        $this->baccaratHistory
            ->where('TableId', '=', $request->get('cancel-TableId'))
            ->where('Round', '=', $request->get('cancel-GameRound'))
            ->where('Run', '=', $request->get('cancel-GameRun'))
            ->update([
                'BaccaratHistory.ModifiedStatus' => $request->get('cancel-ModifiedStatus'),
                'BaccaratHistory.ModifiedTime' => $timeNow
            ]);
    }
}