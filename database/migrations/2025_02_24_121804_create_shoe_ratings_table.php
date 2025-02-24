<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('shoe_ratings', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('rating');
            $table->text('comment')->nullable();
            $table->foreignId('shoe_id')->constrained()->cascadeOnDelete();
            $table->foreignId('product_transaction_id')->constrained()->cascadeOnDelete();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shoe_ratings');
    }
};
