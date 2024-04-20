<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Kalnoy\Nestedset\NestedSet;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('certifications', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description');
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('states', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('code');
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('counties', function (Blueprint $table) {
            $table->id();
            $table->foreignId('state_id')->constrained()->cascadeOnUpdate();
            $table->string('name');
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('cities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('state_id')->constrained('states')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('county_id')->constrained('counties')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('name', 50);
            $table->char('zip');
            $table->decimal('latitude', 12,8);
            $table->decimal('longitude', 12, 8);
            $table->string('timezone');
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('trades', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->softDeletes();
            $table->timestamps();
            $table->nestedSet();
        });

        Schema::create('payment_terms', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50);
            $table->string('code', 6);
            $table->string('description', 250)->default('');
            $table->tinyInteger('net_days')->default(0);
            $table->decimal('cod_amount')->default(0.00);
            $table->decimal('cod_percent')->default(0.00);
            $table->decimal('net_amount')->default(0.00);
            $table->decimal('net_percent')->default(0.00);
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('status_codes', function (Blueprint $table) {
            $table->id();
            $table->string('for_model');
            $table->string('code');
            $table->string('description');
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('contact_positions', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('helper_tables');
    }
};
