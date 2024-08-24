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
            Schema::create('Vehicles', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('user_id');

                $table->integer('year');
                $table->string('make');
                $table->string('model');
                $table->string('color');
                $table->string('trim');
                $table->enum('status', [
                    'New', 'Used', 'Inbound', 'Pending', 'Delivered', 
                    'Swaps', 'Loaners', 'Demos', 'Shop', 'Staging'
                ]);
                $table->string('fg_color');
                $table->string('bg_color');
                $table->timestamps();
                $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            });
       
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Vehicles');
    }
};
