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
        Schema::create("tags", function (Blueprint $table) {
            $table->uuid("id", 36)->primary()->comment("タグID");
            $table->string("name")->comment("タグ名");
            $table->string("description")->comment("備考");
            // タグを使用するターゲットについては、現時点では、
            // players | clan
            //       0 | 0　　　・・・どちらでも使用しない 2(00) = 10(0)
            //       0 | 1     ・・・クランのみで使用 2(01) = 10(1)
            //       1 | 0     ・・・プレイヤーのみで使用 2(10) = 10(2)
            //       1 | 1     ・・・クラン、プレイヤーで使用 2(11) = 10(3)
            // 仕様上、どちらでも使用しない事は想定しないため、2(00)は起こり得ない。
            // 2(00)が起こる場合はバリデーションエラー等でユーザリクエスト時に弾く必要がある。
            // その辺りの実装については、ドメイン層かプレゼンテーション層で対応する。
            $table->integer("target_domain_permission")->comment("タグを使用するターゲット");
            $table->boolean("is_enabled")->comment("タグ有効有無");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists("tags");
    }
};
