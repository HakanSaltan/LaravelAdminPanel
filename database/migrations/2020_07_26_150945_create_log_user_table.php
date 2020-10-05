<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLogUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('log_user', function (Blueprint $table) {
            $table->id();
            $table->int('user_id',50);
            $table->string('islem',150);
            $table->text('islem_aciklama');
            $table->int('islem_kodu',2);
            $table->string('ip',50);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('log_user');
    }
}
