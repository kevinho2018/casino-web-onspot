<?php
/**
 * Created by PhpStorm.
 * User: kevin
 * Date: 2018/8/7
 * Time: 上午11:20
 */

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Services\Api\VideoService;

/**
 * Class VideoController
 * @property VideoService videoService
 * @package App\Http\Controllers\Api
 */
class VideoController extends ApiController
{
    /**
     * VideoController constructor.
     * @param VideoService $videoService
     */
    public function __construct(
        VideoService $videoService
    ) {
        $this->videoService = $videoService;
    }

    /**
     * @param Request $request
     * @return \App\Http\Resources\VideoRecordCollection|\Illuminate\Database\Eloquent\Collection|\Illuminate\Support\Collection|string|static[]
     */
    public function getVideoFilePath(Request $request)
    {
        $input = $request->all();

        return $this->videoService->getVideoReport($input);
    }
}