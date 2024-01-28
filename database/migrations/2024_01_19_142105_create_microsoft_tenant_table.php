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
            $table->string('client_id');
            $table->string('secret_id')->nullable();
            $table->string('secret_value');
            $table->string('description')->nullable();;
            $table->longText('access_token')->nullable();
            $table->timestamps();
        });
    }
};
