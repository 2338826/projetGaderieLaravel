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
        Schema::create('nurseries', function (Blueprint $table) {
            $table->id(); // Clé primaire auto-incrémentée (id : int)
            $table->string('name', 100); // name : varchar(100)
            $table->string('address', 200); // address : varchar(200)
            $table->string('city', 100); // city : varchar(100)
            $table->string('phone', 12); // phone : varchar(12)
            $table->foreignId('id_state')->constrained('states')->onDelete('cascade'); // Clé étrangère vers states (id_state : int)
            // Pas de timestamps car $timestamps = false dans le modèle
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nurseries');
    }
};
