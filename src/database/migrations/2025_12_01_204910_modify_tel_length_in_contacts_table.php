<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyTelLengthInContactsTable extends Migration
{
    public function up()
    {
        Schema::table('contacts', function (Blueprint $table) {
            $table->dropColumn('tel'); // 一度削除
        });

        Schema::table('contacts', function (Blueprint $table) {
            $table->string('tel', 15); // 15桁で作り直し
        });
    }

    public function down()
    {
        Schema::table('contacts', function (Blueprint $table) {
            $table->dropColumn('tel');
        });

        Schema::table('contacts', function (Blueprint $table) {
            $table->string('tel', 255);
        });
    }
}
