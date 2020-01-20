<?php

namespace App\Http\Resources;
use Auth;
use Illuminate\Http\Resources\Json\JsonResource;

class MyOrganizationResource extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return array(
            'id'=>$this->id,
            'name'=>$this->name,
            'user_id'=>$this->owner->id,
            'owner_first_name'=>$this->owner->first_name,
            'owner_last_name'=>$this->owner->last_name,
            'current'=>(auth()->user()->current_organization == $this->id),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        );
    }
}
