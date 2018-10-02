<?php

namespace App\Http\Controllers\CasinoAdmin;

use App\Http\Controllers\Api\ApiController;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use TCG\Voyager\Database\Schema\SchemaManager;
use TCG\Voyager\Facades\Voyager;
use TCG\Voyager\Http\Controllers\VoyagerBaseController;
use App\Services\CasinoAdmin\GameResultService;
use App\Http\Requests\GameResultModifyRequest;
use App\Http\Requests\GameResultCancelRequest;
use App\Services\CasinoAdmin\ServerApiCallRecordService;


/**
 * @property GameResultService gameResultService
 * @property ServerApiCallRecordService serverApiCallRecordService
 */
class GameResultModifyController extends VoyagerBaseController
{
    /**
     * GameResultModifyController constructor.
     * @param GameResultService $gameResultService
     * @param ServerApiCallRecordService $serverApiCallRecordService
     */
    public function __construct(
        GameResultService $gameResultService,
        ServerApiCallRecordService $serverApiCallRecordService
    ) {
        $this->gameResultService = $gameResultService;
        $this->serverApiCallRecordService = $serverApiCallRecordService;
    }

    /**
     * @param Request $request
     * @param null $responseString
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request, $responseString=null)
    {
        return Voyager::view('vendor.voyager.baccarathistory.browse', compact('responseString'));
    }

    /**
     * @param GameResultCancelRequest $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function putCancel(GameResultCancelRequest $request)
    {
        //Voyager::canOrFail('browse_BaccaratHistory');

        // 1. Call Game Server API to cancel remote Database
        // TODO 如果該局沒有注單會噴錯 => 先擋掉？
        // TODO 已修改、已取消的也會噴錯，先擋掉？
        // TODO 後續應該是casino-wep開一支api可以針對沒有注單的牌局改牌型

        // Log Data
        $prepareData = [
            'Account' => Auth::user()->name,
            'Ip' => $request->ip(),
            'RequestContent' =>
                'Game:' . $request->get('cancel-GameSelect') .
                ' Table:' . $request->get('cancel-TableId') .
                ' Round:' . $request->get('cancel-GameRound') .
                ' Run:' . $request->get('cancel-GameRun')
            ,
            'RequestUrl' => $request->getPathInfo(),
            'RequestMethod' => $request->method(),
            'RequestTime' => Carbon::now(),
        ];

        // Call Server Api
        $serverResponse = $this->gameResultService->putCancel($request);
        $prepareData['ResponseTime'] = Carbon::now();

        // Api Failed
        if ( !$this->isResponseSuccess($serverResponse)) {
            $this->serverApiCallRecordService->failed($prepareData, $serverResponse);

            return redirect('admin/baccarathistory')->withErrors([$serverResponse]);
        }

        // 2. Modify Local On-spot Database
        $this->gameResultService->cancelBaccaratHistory($request);
        $this->serverApiCallRecordService->success($prepareData, $serverResponse);

        return redirect('admin/baccarathistory')->with('Message', $serverResponse);
    }

    /**
     * @param GameResultModifyRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function putModify(GameResultModifyRequest $request)
    {
        //Voyager::canOrFail('browse_BaccaratHistory');

        // 1. Call Game Server API to modify remote Database
        // TODO 如果該局沒有注單會噴錯，先擋掉？
        // TODO 已修改、已取消的也會噴錯，先擋掉？
        // TODO 後續應該是casino-wep開一支api可以針對沒有注單的牌局改牌型

        // Log Data
        $prepareData = [
            'Account' => Auth::user()->name,
            'Ip' => $request->ip(),
            'RequestContent' =>
                "Game:" . $request->get('modify-GameSelect') .
                ' Table:' . $request->get('modify-TableId') .
                ' Round:' . $request->get('modify-GameRound') .
                ' Run:' . $request->get('modify-GameRun') .
                ' Cards:' .
                $request->get('player-card-1') . ',' .
                $request->get('banker-card-1') . ',' .
                $request->get('player-card-2') . ',' .
                $request->get('banker-card-2') . ',' .
                $request->get('player-card-3') . ',' .
                $request->get('banker-card-3') . ','
            ,
            'RequestUrl' => $request->getPathInfo(),
            'RequestMethod' => $request->method(),
            'RequestTime' => Carbon::now()
        ];

        // Call Server Api
        $serverResponse = $this->gameResultService->putModify($request);
        $prepareData['ResponseTime'] = Carbon::now();

        if ( !$this->isResponseSuccess($serverResponse)) {
            $this->serverApiCallRecordService->failed($prepareData, $serverResponse);

            return redirect('admin/baccarathistory')->withErrors([$serverResponse]);
        }

        // 2. Modify Local On-spot Database
        $this->gameResultService->modifyBaccaratHistory($request);
        $this->serverApiCallRecordService->success($prepareData, $serverResponse);

        return redirect('admin/baccarathistory')->with('Message', $serverResponse);
    }

    /**
     * @param $responseString
     * @return bool
     */
    private function isResponseSuccess($responseString)
    {
        $temp = (explode(",", explode(":", $responseString)[2])[0]);
        $result = str_replace('"', '', $temp);

        return $result == "error" ? false : true;
    }
}
