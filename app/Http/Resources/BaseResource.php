<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BaseResource extends JsonResource
{
    /**
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {
        $result = parent::toArray($request);
        if ($this->translates):
            $result['translates'] = json_decode($this->translates, true);
        endif;
        return $result;
    }
}
