<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
	public function up(): void
	{
		Schema::create('chat_messages', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->unsignedBigInteger('thread_id');
			$table->unsignedBigInteger('sender_admin_id')->nullable();
			$table->unsignedBigInteger('sender_customer_id')->nullable();
			$table->string('sender_guest_token', 100)->nullable();
			$table->text('message');
			$table->boolean('is_system')->default(false);
			$table->timestamp('read_at')->nullable();
			$table->timestamps();

			$table->index('thread_id');
		});
	}

	public function down(): void
	{
		Schema::dropIfExists('chat_messages');
	}
};


