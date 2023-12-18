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
        Schema::create('user_posts', function (Blueprint $table) {
            $table->uuid("id", 36)->primary()->comment("ユーザ投稿ID");
            $table->enum("platform", [
                "PC",
                "PS4",
                "Xbox",
            ])->comment("プラットフォーム");
            $table->text("message")->comment("メッセージ");
            // true = ログインユーザのみ表示する、 false = 誰でも表示する
            $table->boolean("is_display_logged_in_user")->comment("ログインユーザにのみ表示可否");
            $table->uuid("created_user_id", 36)->comment("作成ユーザID");
            $table->datetime("close_at")->nullable()->comment("受付終了日時");
            $table->datetime("created_at")->comment("作成日時");

            $table->foreign("created_user_id")->references("id")->on("users")->onUpdate("CASCADE")->onDelete("CASCADE");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_posts');
    }
};
