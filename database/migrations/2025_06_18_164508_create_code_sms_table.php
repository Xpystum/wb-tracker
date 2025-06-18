<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('code_sms', function (Blueprint $table) {

            $table->id();

            $table->string('code')->comment('Код подтверждения');
            $table->foreignId('user_id')->constrained('users');
            $table->dateTime('time_send')->comment('Через какое время можно повторно отправить код');
            $table->boolean('status')->default(false)->comment('Статус активации');

            $table->timestamps();

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('code_sms');
    }
};
