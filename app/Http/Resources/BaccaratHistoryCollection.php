<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

/**
 * Class BaccaratHistoryCollection
 * @package App\Http\Resources
 */
class BaccaratHistoryCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        //return parent::toArray($request);

        return [
            "status" => "Success",
            "modifiedStatus" => $request->get('modifiedStatus'),
            "data" => $this->collection,
        ];
    }
}
