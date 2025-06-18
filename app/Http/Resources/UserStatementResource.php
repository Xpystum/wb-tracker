<?php

namespace App\Http\Resources;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserStatementResource extends JsonResource
{

    public function toArray(Request $request): array
    {
        /** @var User $this */
        return [
            'id' => $this->id,
            'track_number' => $this->track_number,

            'name' => $this->name,
            'surname' => $this->surname,
            'fathername' => $this->fathername,

            'birthday' => $this->birthday,
            'phone' => $this->phone,

            'series_passport' => $this->series_passport,
            'number_passport' => $this->number_passport,

            'comment' => $this->comment,
        ];
    }
}
