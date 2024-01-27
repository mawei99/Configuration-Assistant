<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void {
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name');
            $table->string('value');
            $table->foreignId(\App\Models\Configuration\Property\PropertyType::class);
        });
    }

    public function down(): void {
        Schema::dropIfExists('properties');
    }
};
