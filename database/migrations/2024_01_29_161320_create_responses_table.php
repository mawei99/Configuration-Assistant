<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void {
        Schema::create('responses', function (Blueprint $table) {
            $table->id();
            $table->string('microsoft_tenant_name');
            $table->string('configuration_name')->nullable();
            $table->longText('configuration_properties')->nullable();
            $table->string('user_name');
            $table->integer('response_code');
            $table->longText('headers');
            $table->longText('body');
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('responses');
    }
};
