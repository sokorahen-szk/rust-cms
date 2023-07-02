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
        Schema::create("roles", function (Blueprint $table) {
            $table->uuid("id", 36)->primary()->comment("ロールID");
            // 権限レベルは、なし,r,w,rwのレベルを2進数->16進数に変換して管理する。
            // 記録されたpermissionの値を使うと時は、16進数->2進数に変換して制御を行う。
            // (0)10 (00)2 = なし
            // (1)10 (01)2 = 読み込み(r)
            // (2)10 (10)2 = 書き込み(w)
            // (3)10 (11)2 = 読み書き/書き込み(rw)
            // 例えば、ユーザ作成とプレイヤー作成の画面があるとする。
            // ユーザ作成 (00)2 プレイヤー作成 (00)2 の場合、権限レベルは(0000)2 (0)16となる。
            // ユーザ作成 (01)2 プレイヤー作成 (11)2 の場合、権限レベルは(0111)2 (7)16となる。
            $table->string("permission")->comment("権限レベル");
            $table->string("description")->nullable()->comment("備考");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists("roles");
    }
};
