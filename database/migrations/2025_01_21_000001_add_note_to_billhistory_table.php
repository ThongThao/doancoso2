<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNoteToBillhistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('billhistory', function (Blueprint $table) {
            $table->text('Note')->nullable()->after('Status');
            $table->string('AdminName', 50)->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('billhistory', function (Blueprint $table) {
            $table->dropColumn('Note');
            $table->string('AdminName', 50)->nullable(false)->change();
        });
    }
}
