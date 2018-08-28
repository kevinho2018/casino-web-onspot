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

/**
 * Class GameResultController
 * @package App\Http\Controllers\CasinoAdmin
 */
class GameResultController extends VoyagerBaseController
{
    /**
     * @param Request $request
     * @return int
     */
    public function searchResult(Request $request)
    {
        Voyager::canOrFail('browse_admin');

        return view('gameResult');
    }


}