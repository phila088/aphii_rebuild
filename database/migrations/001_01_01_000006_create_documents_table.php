<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('document_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->softDeletes();
            $table->timestamps();
            $table->nestedSet();
        });

        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('company_id')->nullable()->constrained('companies')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('client_id')->nullable()->constrained('clients')->cascadeOnDelete()->cascadeOnUpdate();
            // $table->foreignId('vendor_id')->nullable()->constrained('vendors')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('document_category_id')->constrained('document_categories')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('title');
            $table->string('description')->nullable();
            $table->string('type');
            $table->string('size');
            $table->string('path');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};
