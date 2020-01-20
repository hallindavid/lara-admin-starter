<?php

namespace App\Http\Resources;
use Illuminate\Support\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class MyInvitationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'invitation_id'=>$this->id,
            'created_at'=>Carbon::createFromFormat('Y-m-d H:i:s', $this->created_at, config('app.timezone'))->setTimezone(auth()->user()->timezone)->format('Y-m-d g:i a'),
            'org_name'=>$this->organization->name
        ];
    }
}
