<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_email_verify_tokens', function (Blueprint $table) {
            $table->uuid("id", 36)->primary()->comment("ユーザメール検証トークンID");
            $table->uuid("user_id", 36)->unique()->comment("ユーザID");
            $table->boolean("verified")->comment("検証済み判定");
            $table->dateTime("expires_at")->comment("有効期限");

            $table->foreign("user_id")->references("id")->on("users")->onUpdate("CASCADE")->onDelete("CASCADE");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_email_verify_tokens');
    }
};
