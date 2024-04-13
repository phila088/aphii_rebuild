<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Kalnoy\Nestedset\NestedSet;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('name', 50)->unique();
            $table->string('dba', 50)->nullable()->unique();
            $table->string('abbreviation', 50)->unique();
            $table->string('iwo_prefix', 50)->unique();
            $table->integer('iwo_max_length')->default(5);
            $table->integer('iwo_postfix_increment')->default(10);
            $table->string('logo_path')->nullable();
            $table->softDeletes();
            $table->timestamps();
            $table->nestedSet();
        });

        Schema::create('company_addresses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('company_id')->constrained('companies')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('title', 50);
            $table->string('building_number')->nullable();
            $table->string('pre_direction')->nullable();
            $table->string('street_name')->nullable();
            $table->string('street_type')->nullable();
            $table->string('post_direction')->nullable();
            $table->string('unit_type')->nullable();
            $table->string('unit')->nullable();
            $table->string('po_box')->nullable();
            $table->string('city');
            $table->string('state');
            $table->string('zip');
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('company_emails', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('company_id')->constrained('companies')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('title', 50);
            $table->string('email', 100);
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('company_phones', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('company_id')->constrained('companies')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('title', 50);
            $table->string('phone', 20);
            $table->string('extension', 20);
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('company_hours', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('company_id')->constrained('companies')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('day_of_week', 20);
            $table->time('open_time');
            $table->time('close_time');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};
