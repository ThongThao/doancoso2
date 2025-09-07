<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
	public function up(): void
	{
		Schema::create('chat_threads', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->unsignedBigInteger('customer_id')->nullable();
			$table->string('guest_token', 100)->nullable();
			$table->string('subject')->nullable();
			$table->boolean('is_closed')->default(false);
			$table->unsignedBigInteger('created_by_admin_id')->nullable();
			$table->timestamps();

			$table->index('customer_id');
			$table->index('guest_token');
		});
	}

	public function down(): void
	{
		Schema::dropIfExists('chat_threads');
	}
};


