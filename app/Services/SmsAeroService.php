<?php

namespace App\Services;

use App\Models\CodeSms;
use App\Models\User;
use SmsAero\SmsAeroMessage;

class SmsAeroService
{
    public function __construct(
        private readonly SmsAeroMessage $smsAeroMessage
    ) { }

    public function send(
        User $user,
    ) : array {

        $codeSms = $user->codeSms()->orderBy('id', 'desc')->first();

        if($codeSms) {

            if($codeSms->time_send <= now()) {

                $codeSms = CodeSms::create([
                    'code' => rand(100_000_00, 999_999_99),
                    'user_id' => $user->id,
                    'time_send' => now()->addminutes(1),
                ]);

            } else {
                return $this->responseStatus(false,'Подождите ещё 1 минуту, что бы отправить код');
            }

        } else {
            $codeSms = CodeSms::create([
                'code' => rand(100_000_00, 999_999_99),
                'user_id' => $user->id,
                'time_send' => now()->addminutes(1),
            ]);
        }

        $response = $this->smsAeroMessage->send([
            'number' => $user->phone,
            'text' => "Ваш код подтверждения: {$codeSms->code}",
            'sign' => 'SMS Aero'
        ]);

        return $response['success']
            ? $this->responseStatus(true,'Код успешно отправлен.')
                : $this->responseStatus(false,'Ошибка отправки повторного кода.');
    }

    public function confirm(
        User $user,
        string $code,
    ) : array {

        /** @var CodeSms $codeSmsLast */
        $lastCodeSms = $user->codeSms()->orderBy('id', 'desc')->first();

        if( $lastCodeSms ) {
          if($lastCodeSms->code === $code) {

              $user->status = true;
              $lastCodeSms->status = true;

              return ($user->save() && $lastCodeSms->save()) ? $this->responseStatus(true,'Код успешно подтверждён')
                  : $this->responseStatus(false,'Код неверный.');
          }
          return $this->responseStatus(false,'Код неверный.');
        }

        return $this->responseStatus(false,'Код неверный.');
    }




    private function responseStatus(bool $status, string $messages) : array
    {
        return [
            'status' => $status,
            'message' => $messages
        ];
    }
}
