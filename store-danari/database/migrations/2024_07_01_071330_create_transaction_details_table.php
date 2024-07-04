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
        Schema::create('transaction_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('transactions_id')->constrained()->onDelete('cascade');
            $table->foreignId('products_id')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('price');
            $table->string('resi');
            $table->string('code');
            $table->string('shipping_status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaction_details');
    }
};
