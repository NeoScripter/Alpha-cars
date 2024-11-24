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
        Schema::create('suppliers', function (Blueprint $table) {
            $table->id();
            $table->string('image')->nullable(); // Path to image
            $table->string('name'); // Supplier name
            $table->float('stars')->default(0); // Average star rating
            $table->json('emails')->nullable(); // Emails as JSON
            $table->json('phones')->nullable(); // Phones as JSON
            $table->string('website')->nullable(); // Website URL
            $table->string('platform_address')->nullable(); // Platform address
            $table->string('unload_address')->nullable(); // Unload address
            $table->string('legal_entity')->nullable(); // Legal entity name
            $table->string('itn')->nullable(); // Tax identification number
            $table->string('rrc')->nullable(); // RRC (e.g., regulatory code)
            $table->string('rating')->nullable(); // Supplier rating
            $table->string('carType')->nullable(); // Type of cars
            $table->json('carSubtype')->nullable(); // Car subtypes as JSON
            $table->json('carMake')->nullable(); // Car makes as JSON
            $table->string('workTerms')->nullable(); // Terms of work
            $table->string('supervisor')->nullable(); // Supervisor name
            $table->boolean('dkp')->default(false); // DKP status (boolean)
            $table->boolean('image_spec')->default(false); // Whether image specs are met
            $table->string('signees')->nullable(); // Signees for documents
            $table->boolean('warantees')->default(false); // Warranty provided
            $table->boolean('payWithoutPTC')->default(false); // Payment without PTC
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('suppliers');
    }
};
