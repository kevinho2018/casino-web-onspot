<?php
/**
 * Created by PhpStorm.
 * User: kevin
 * Date: 2018/8/7
 * Time: 上午11:20
 */

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Api\VideoService;

/**
 * @property VideoService videoService
 */
class VideoController extends Controller
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

        if (!$request->isMethod('GET')) {
            //throw $this->methodNotAllowedHttpException;
            return json_encode(['Code' => 1, 'Message' => 'Method not allow.']);
        }

        return $this->videoService->getVideoReport($input);
    }
}