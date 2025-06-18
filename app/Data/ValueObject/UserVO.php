<?php

namespace App\Data\ValueObject;

use App\Traits\FilterArrayTrait;
use Illuminate\Support\Arr;
use Illuminate\Contracts\Support\Arrayable;

class UserVO implements Arrayable
{
    use FilterArrayTrait;

    public function __construct(

        public string $track_number,

        public string $name,
        public string $surname,
        public string $fathername,

        public string $birthday,
        public string $phone,

        public string $series_passport,
        public string $number_passport,

        public ?string $comment,

    ){ }

    public static function make(

        string $track_number,

        string $name,
        string $surname,
        string $fathername,

        string $birthday,
        string $phone,

        string $series_passport,
        string $number_passport,

        string $comment,

    ) : static {

        return new static(
            track_number: $track_number,
            name: $name,
            surname: $surname,
            fathername: $fathername,
            birthday: $birthday,
            phone: $phone,
            series_passport: $series_passport,
            number_passport: $number_passport,
            comment: $comment,
        );

    }

    public function toArray()
    {
        return [
            "track_number" => $this->track_number,
            "name" => $this->name,
            "surname" => $this->surname,
            "fathername" => $this->fathername,
            "birthday" => $this->birthday,
            "phone" => $this->phone,
            "series_passport" => $this->series_passport,
            "number_passport" => $this->number_passport,
            "comment" => $this->comment,
        ];
    }

    public static function arrayToObject(array $data)
    {
        return static::make(
            track_number: Arr::get($data, 'track_number'),
            name: Arr::get($data, 'name'),
            surname: Arr::get($data, 'surname'),
            fathername: Arr::get($data, 'fathername'),
            birthday: Arr::get($data, 'birthday'),
            phone: Arr::get($data, 'phone'),
            series_passport: Arr::get($data, 'series_passport'),
            number_passport: Arr::get($data, 'number_passport'),
            comment: Arr::get($data, 'comment', null),
        );
    }
}
