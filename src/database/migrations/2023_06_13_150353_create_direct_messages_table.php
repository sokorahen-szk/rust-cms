<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('direct_messages', function (Blueprint $table) {
            $table->uuid("id", 36)->primary()->comment("ダイレクトメッセージID");
            $table->uuid("src_user_id", 36)->comment("送信元ユーザID");
            $table->uuid("dest_user_id", 36)->comment("送信先ユーザID");
            $table->text("message")->comment("メッセージ");
            $table->timestamps();

            $table->foreign("src_user_id")->references("id")->on("users")->onUpdate("CASCADE")->onDelete("CASCADE");
            $table->foreign("dest_user_id")->references("id")->on("users")->onUpdate("CASCADE")->onDelete("CASCADE");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('direct_messages');
    }
};
