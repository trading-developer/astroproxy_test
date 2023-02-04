<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->decimal('price');
            $table->unsignedInteger('status')->default(\App\Models\Service::STATUS_ACTIVE);
            $table->string('name');
            $table->text('description')->nullable();
            $table->timestamps();
        });

        Schema::create('payments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->boolean('is_autopay')->default(false);

            /**
             * Для чего тут поле с суммой если мы знаем конкретную стоимость услуги?
             * 1) оплата сервиса может быть частями, 2) оплата может быть зачислена сначала в личный кабинет
             */
            $table->decimal('total');
            $table->unsignedInteger('status')->default(1);
            $table->unsignedInteger('payment_method')->default(1);
            $table->text('comment')->nullable();
            $table->timestamps();

            $table->foreignId('user_id')
                ->references('id')
                ->on('users');

            $table->foreignId('service_id')
                ->references('id')
                ->on('services');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('services');
        Schema::dropIfExists('payments');
    }
};
