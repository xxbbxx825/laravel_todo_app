<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TaskResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        if((int)$this->status === 0) {
            $this->status = 'To Do';
        }
        if((int)$this->status === 1) {
            $this->status = 'Doing';
        }
        if((int)$this->status === 2) {
            $this->status = 'Done';
        }
        return [
            'id' => $this->id,
            'title' => $this->title,
            'status' => $this->status,
            'due' => $this->due,
        ];
    }
}
