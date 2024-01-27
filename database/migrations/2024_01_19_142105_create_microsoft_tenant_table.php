<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void {
        Schema::create('microsoft_tenants', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('tenant_id');
            $table->string('application_id');
            $table->string('secret');
            $table->string('access_token')->nullable();
            $table->timestamps();
        });
    }
};
