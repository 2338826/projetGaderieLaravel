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
        Schema::create('expenses', function (Blueprint $table) {
            $table->id();
            $table->dateTime('dateTime');
            $table->decimal('amount',13,2);
            $table->foreignId('nursery_id')->constrained('nurseries')->onDelete('cascade');
            $table->foreignId('commerce_id')->constrained('commerces')->onDelete('cascade');
            $table->foreignId('category_expense_id')->constrained('expense_categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('expenses');
    }
};
