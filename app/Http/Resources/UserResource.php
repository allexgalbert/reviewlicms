<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource {

  public function toArray($request) {

    //return [
    //  'type' => 'users',
    //  'id' => $this->id,
    //  'attributes' => [
    //    'name' => $this->name,
    //  ],
    //];

    return parent::toArray($request);
  }
}
