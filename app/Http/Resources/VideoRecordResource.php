<?php
/**
 * Created by PhpStorm.
 * User: kevin
 * Date: 2018/8/9
 * Time: 下午6:06
 */

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class VideoRecordResource
 * @package App\Http\Resources
 */
class VideoRecordResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        //return parent::toArray($request);

        return [
            'TableId' => $this->TableId,
            'Round' => $this->Round,
            'Run' => $this->Run,
            'StartTime' => $this->StartTime
        ];
    }
}