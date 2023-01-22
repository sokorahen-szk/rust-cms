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
        Schema::create("users", function (Blueprint $table) {
            $table->id()->comment("ユーザID");
            $table->string("name")->comment("ユーザ名");
            $table->integer("role_id")->comment("ロールID");
            $table->string("email")->unique()->nullable()->comment("メールアドレス");
            $table->timestamp("email_verified_at")->nullable()->comment("メールアドレス有効化日時");
            $table->string("password")->comment("パスワード");
            $table->string("description")->nullable()->comment("備考");
            $table->integer("created_user_id")->nullable()->comment("作成ユーザID");
            $table->timestamps();

            $table->foreign("role_id")->references("id")->on("roles")->onUpdate("RESTRICT")->onDelete("RESTRICT");
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
        Schema::dropIfExists("users");
    }
};
