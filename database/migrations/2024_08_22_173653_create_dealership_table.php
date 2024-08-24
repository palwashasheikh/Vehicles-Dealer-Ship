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
        Schema::create('Dealership', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('Dealercode');
            $table->string('address1');
            $table->string('address2')->nullable();
            $table->string('zip_code');
            $table->string('state');
            $table->string('contact_email')->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('_dealership');
    }
};
