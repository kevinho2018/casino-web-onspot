<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class BaccaratHistoryResource
 * @package App\Http\Resources
 */
class BaccaratHistoryResource extends JsonResource
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
            'WinSpot' => $this->WinSpot,
            'Card1' => $this->Card1,
            'Card2' => $this->Card2,
            'Card3' => $this->Card3,
            'Card4' => $this->Card4,
            'Card5' => $this->Card5,
            'Card6' => $this->Card6,
            'ModifiedStatus' => $this->ModifiedStatus,
            'ModifiedTime' => $this->ModifiedTime,
            'CreateTime'  => $this->CreateTime
        ];
    }
}
