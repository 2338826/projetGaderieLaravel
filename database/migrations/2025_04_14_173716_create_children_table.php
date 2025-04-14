<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('children', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->string('firstName', 100);
            $table->dateTime('birth_date');
            $table->string('address', 200);
            $table->string('city', 100);
            $table->foreignId('id_state')->constrained('states')->onDelete('cascade');
            $table->string('phone', 12);

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('children');
    }
};
