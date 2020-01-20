<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Resources\Json\JsonResource;

class OrganizationListResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return array(
            'id'=>$this->id,
            'name'=>$this->name,
            'owner_id'=>$this->owner->id,
            'owner_first_name'=>$this->owner->first_name,
            'owner_last_name'=>$this->owner->last_name,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        );
    }
}
