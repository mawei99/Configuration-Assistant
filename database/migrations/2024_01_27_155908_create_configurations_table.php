<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void {
        Schema::create('configurations', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name');
            $table->foreignId(\App\Models\Configuration\ConfigurationTemplate::class);
        });
    }

    public function down(): void {
        Schema::dropIfExists('configurations');
    }
};
