<?php

namespace App\Action;



use App\Data\ValueObject\UserVO;
use App\Exceptions\CreateUserStatementException;

use App\Models\User;
use Log;

final class CreateUserStatementAction
{
    public static function make(UserVO $vo) : User
    {
        return (new self())->run($vo);
    }

    private function run(UserVO $vo) : User
    {

        try {

            $model = User::query()->create($vo->toArrayNotNull());

        } catch (\Throwable $th) {

            $nameClass = self::class;

            Log::info("Ошибка в {$nameClass} при создании записи: " . $th);
            throw new CreateUserStatementException('Ошибка в классе: ' . $nameClass, 500);

        }

        return $model;
    }
}
