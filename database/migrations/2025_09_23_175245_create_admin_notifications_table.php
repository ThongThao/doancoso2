<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_notifications', function (Blueprint $table) {
            $table->id();
            $table->string('type'); // 'new_order', 'order_status_change', etc.
            $table->string('title');
            $table->text('message');
            $table->json('data')->nullable(); // Additional data like order ID, customer info
            $table->boolean('is_read')->default(false);
            $table->integer('admin_id')->nullable(); // If for specific admin, null for all admins
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admin_notifications');
    }
}
