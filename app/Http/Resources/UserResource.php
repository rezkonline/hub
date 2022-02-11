<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'manager_id' => $this->manager_id,
            'employee_id' => $this->employee_id,
            'type' => $this->type,
            'avatar' => $this->getAvatar(),
            'credit' => $this->getWallet(),
            'payed' => $this->getPayedTransactions(),
            'purchases' => $this->getPurchases(),
            'notifications' => NotificationResource::collection($this->unreadNotifications()->limit(10)->get()),
            'impersonator' => new ImpersonatorResource(\App\Models\User::find(app('impersonate')->getImpersonatorId())),
            'attachments' => MediaResource::collection($this->getMedia('attachments')),
            'settings' => $this->getCurrentSettings(),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
