<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BookRequest extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        return [
            'name' => $this->name,
            'remarks' => $this->remarks,
            'category' => $this->category->name,
            'user' => $this->user->name,
            'mobile' => $this->user->mobile,
        ];
    }
}
