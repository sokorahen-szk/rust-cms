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
        Schema::create("users", function (Blueprint $table) {
            $table->uuid("id", 36)->primary()->comment("ユーザID");
            $table->string("account_id")->unique()->comment("アカウントID");
            $table->string("name")->comment("ユーザ名");
            //
            // users.status
            // WAITING - アカウント作成途中で中断した場合
            // INACTIVE - アカウント無効
            // ACTIVE - アカウント有効
            // WITHDRAWN - アカウント退会済み
            // SPECIAL_REQUIREMENT_LOCK - 運用上、特殊な用件で使用する場合にロックする
            // BANNED - アカウント停止
            //
            $table->enum("status", [
                "WAITING",
                "INACTIVE",
                "ACTIVE",
                "WITHDRAWN",
                "SPECIAL_REQUIREMENT_LOCK",
                "BANNED"
            ])->comment("ユーザステータス");
            $table->uuid("role_id", 36)->comment("ロールID");
            $table->string("email")->unique()->nullable()->comment("メールアドレス");
            $table->timestamp("email_verified_at")->nullable()->comment("メールアドレス有効化日時");
            $table->string("battle_metrics_id")->nullable()->comment("BattleMetricsID");
            $table->string("discord_id")->nullable()->comment("DiscordID");
            $table->string("twitter_id")->nullable()->comment("TwitterID");
            $table->string("steam_id")->nullable()->comment("SteamID");
            $table->string("password")->comment("パスワード");
            $table->string("description")->nullable()->comment("備考");
            $table->uuid("created_user_id", 36)->nullable()->comment("作成ユーザID");
            $table->timestamps();

            $table->foreign("role_id")->references("id")->on("roles")->onUpdate("RESTRICT")->onDelete("RESTRICT");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists("users");
    }
};
