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
        Schema::create('accounts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->enum('type', ['individual', 'bussiness'])->default('individual');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('mobile_phone');
            $table->date('birthdate')->nullable();
            $table->string('cpf')->nullable()->unique();
            $table->string('cnpj')->nullable()->unique();
            $table->string('account_number')->unique();
            $table->string('agency_number')->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('accounts');
    }
};
