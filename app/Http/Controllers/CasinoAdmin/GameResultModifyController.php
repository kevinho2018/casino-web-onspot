<?php

namespace App\Http\Controllers\CasinoAdmin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use TCG\Voyager\Database\Schema\SchemaManager;
use TCG\Voyager\Facades\Voyager;
use TCG\Voyager\Http\Controllers\VoyagerBaseController;
use App\Services\CasinoAdmin\GameResultService;
use App\Http\Requests\GameResultModifyRequest;
use App\Http\Requests\GameResultCancelRequest;


/**
 * @property GameResultService gameResultService
 */
class GameResultModifyController extends VoyagerBaseController
{
    /**
     * GameResultModifyController constructor.
     * @param GameResultService $gameResultService
     */
    public function __construct(
        GameResultService $gameResultService
    ) {
        $this->gameResultService = $gameResultService;
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
        Voyager::canOrFail('browse_BaccaratHistory');

        // 1. Call Game Server API to cancel remote Database
        // TODO 如果該局沒有注單會噴錯 => 先擋掉？
        // TODO 已修改、已取消的也會噴錯，先擋掉？
        // TODO 後續應該是casino-wep開一支api可以針對沒有注單的牌局改牌型
        $responseString = $this->gameResultService->putCancel($request);

        if ( !$this->isResponseSuccess($responseString)) {
            return redirect('admin/baccarathistory')->withErrors([$responseString]);
        }

        // 2. Modify Local On-spot Database
        $this->gameResultService->cancelBaccaratHistory($request);

        return redirect('admin/baccarathistory')->with('Message', $responseString);
    }

    /**
     * @param GameResultModifyRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function putModify(GameResultModifyRequest $request)
    {
        Voyager::canOrFail('browse_BaccaratHistory');

        // 1. Call Game Server API to modify remote Database
        // TODO 如果該局沒有注單會噴錯，先擋掉？
        // TODO 已修改、已取消的也會噴錯，先擋掉？
        // TODO 後續應該是casino-wep開一支api可以針對沒有注單的牌局改牌型
        $responseString = $this->gameResultService->putModify($request);

        if ( !$this->isResponseSuccess($responseString)) {
            return redirect('admin/baccarathistory')->withErrors([$responseString]);
        }

        // 2. Modify Local On-spot Database
        $this->gameResultService->modifyBaccaratHistory($request);

        return redirect('admin/baccarathistory')->with('Message', $responseString);
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
