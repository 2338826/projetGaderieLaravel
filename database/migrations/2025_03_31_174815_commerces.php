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
        Schema::create('commerces', function (Blueprint $table) {
            $table->id(); // Clé primaire auto-incrémentée (id : int)
            $table->string('description',50); // Description de la dépense (Description : string)
            $table->string('address',200); // Adresse de la dépense (Address : string)
            $table->string('phone',12); // Catégorie de la dépense (Category : string)
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
