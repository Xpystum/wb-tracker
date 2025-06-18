<?php

namespace App\Http\Controllers;

use App\Action\CreateUserStatementAction;
use App\Http\Requests\ConfirmSmsStatementRequest;
use App\Http\Requests\StatementStoreRequest;
use App\Http\Resources\UserStatementResource;
use App\Models\User;
use App\Services\SmsAeroService;


class StatementController extends Controller
{

    public function store(
        StatementStoreRequest $request,
        SmsAeroService $smsAeroService,
    ) {
        $userVO = $request->arrayToUserVO();

        /** @var User $user */
        $user = CreateUserStatementAction::make($userVO);

        /** @var bool $status */
        $status = $smsAeroService->send($user);

        return UserStatementResource::make($user);

    }

    public function confirm(
        User $user,
        ConfirmSmsStatementRequest $request,
        SmsAeroService $smsAeroService,
    ) {

        $validated = $request->validated();

        $status = $smsAeroService->confirm($user, $validated['code']);

        return $status['status'] ? response()->json($status, 200)
            : response()->json($status, 422);

    }

    public function send(
        User $user,
        SmsAeroService $smsAeroService,
    ) {

        $status = $smsAeroService->send($user);

        return $status['status'] ? response()->json($status, 200)
            : response()->json($status, 422);

    }

}
