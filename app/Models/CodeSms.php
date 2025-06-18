<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @property int $id
 * @property string $code код подтверждения
 * @property int $user_id
 * @property \Illuminate\Support\Carbon $time_send через какое время можно повторно отправить код
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CodeSms newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CodeSms newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CodeSms query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CodeSms whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CodeSms whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CodeSms whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CodeSms whereTimeSend($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CodeSms whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CodeSms whereUserId($value)
 * @mixin \Eloquent
 */
class CodeSms extends Model
{

    protected $table = 'code_sms';

    protected $fillable = [
        'code',
        'user_id',
        'time_send',
        'status',
    ];

    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'time_send' => 'datetime',
    ];

}
