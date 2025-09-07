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
        Schema::create('product_reviews', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('product_id');
            $table->unsignedInteger('customer_id')->nullable();
            $table->string('customer_name', 100);
            $table->string('customer_email', 100)->nullable();
            $table->tinyInteger('rating')->unsigned(); // 1-5 stars
            $table->string('title', 200)->nullable();
            $table->text('review_text');
            $table->json('images')->nullable(); // Store review images
            $table->boolean('is_verified_purchase')->default(false);
            $table->boolean('is_approved')->default(true);
            $table->boolean('is_featured')->default(false);
            $table->integer('helpful_count')->default(0);
            $table->json('helpful_users')->nullable(); // Track who found it helpful
            $table->timestamp('verified_at')->nullable();
            $table->timestamps();
            
            // Indexes for performance
            $table->index(['product_id', 'is_approved']);
            $table->index(['customer_id']);
            $table->index(['rating']);
            $table->index(['created_at']);
            
            // Foreign key constraints
            $table->foreign('product_id')->references('idProduct')->on('product')->onDelete('cascade');
            $table->foreign('customer_id')->references('idCustomer')->on('customer')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_reviews');
    }
};
