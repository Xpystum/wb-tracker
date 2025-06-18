<?php

namespace App\Http\Controllers;

use App\Action\CreateUserStatementAction;
use App\Data\ValueObject\UserVO;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\StatementStoreRequest;
use JetBrains\PhpStorm\NoReturn;

class StatementController extends Controller
{

    public function store(StatementStoreRequest $request)
    {
        $userVO = $request->arrayToUserVO();

        /** @var User $user */
        $user = CreateUserStatementAction::make($userVO);

        return $user;
    }

}
