<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCassoFieldsToBillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bill', function (Blueprint $table) {
            if (!Schema::hasColumn('bill', 'OrderCode')) {
                $table->string('OrderCode')->nullable()->after('idBill');
            }
            if (!Schema::hasColumn('bill', 'TransactionId')) {
                $table->string('TransactionId')->nullable()->after('OrderCode');
            }
            if (!Schema::hasColumn('bill', 'Payment')) {
                $table->string('Payment', 50)->nullable()->after('TransactionId');
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('bill', function (Blueprint $table) {
            $table->dropColumn(['OrderCode', 'TransactionId', 'Payment']);
        });
    }
}
