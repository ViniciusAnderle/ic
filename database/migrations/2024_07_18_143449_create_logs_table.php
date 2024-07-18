<?php
// Em database/migrations/YYYY_MM_DD_HHmmSS_create_logs_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLogsTable extends Migration
{
    public function up()
    {
        Schema::create('system_logs', function (Blueprint $table) {
            $table->id();
            $table->string('action'); // Ação realizada (ex: create_customer, update_hotel, login, logout, etc.)
            $table->text('description')->nullable(); // Descrição detalhada da ação (opcional)
            $table->unsignedBigInteger('user_id')->nullable(); // ID do usuário (opcional)
            $table->timestamp('login_at')->nullable(); // Momento do login (opcional)
            $table->timestamps();

            // Chave estrangeira para usuário
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('system_logs');
    }
}
