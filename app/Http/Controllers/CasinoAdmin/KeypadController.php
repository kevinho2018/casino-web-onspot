<?php
/**
 * Created by PhpStorm.
 * User: kevin
 * Date: 2018/8/31
 * Time: 上午10:13
 */

namespace App\Http\Controllers\CasinoAdmin;

use TCG\Voyager\Http\Controllers\VoyagerBaseController;
use Illuminate\Http\Request;
use TCG\Voyager\Facades\Voyager;

class KeypadController extends VoyagerBaseController
{
    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function keyPadConsole(Request $request)
    {
        Voyager::canOrFail('browse_admin');

        // TODO 1. 需實作 呼叫KeyServer Api去開啟關閉維護
        // TODO 2. 需實作 拿取即時維護狀態 在維護頁面顯示維護狀態

        return view('CasinoAdmin.phpinfo');
    }
}
