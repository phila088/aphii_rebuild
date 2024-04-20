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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->foreignId('created_by')->nullable()->references('id')->on('users')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->boolean('active')->default(false);
            $table->boolean('locked')->default(false);
            $table->boolean('client')->default(false);
            $table->boolean('employee')->default(false);
            $table->boolean('technician')->default(false);
            $table->boolean('vendor')->default(false);
            $table->rememberToken();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('user_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('email_personal')->nullable();
            $table->string('phone_personal')->nullable();
            $table->string('phone_mobile')->nullable();
            $table->string('phone_work')->nullable();
            $table->string('phone_work_extension')->nullable();
            $table->string('building_number')->nullable();
            $table->string('pre_direction')->nullable();
            $table->string('street_name')->nullable();
            $table->string('street_type')->nullable();
            $table->string('post_direction')->nullable();
            $table->string('unit_type')->nullable();
            $table->string('unit')->nullable();
            $table->string('po_box')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->char('address_zip')->nullable();
            $table->string('timezone')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->text('about')->nullable();
            $table->string('profile_picture_path')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('user_profile_has_certifications', function (Blueprint $table) {
            $table->foreignId('user_profile_id')->constrained('user_profiles')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('certification_id')->constrained('certifications')->cascadeOnDelete()->cascadeOnUpdate();
            $table->primary(['user_profile_id', 'certification_id']);
        });

        Schema::create('user_profile_has_trades', function (Blueprint $table) {
            $table->foreignId('user_profile_id')->constrained('user_profiles')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('trade_id')->constrained('trades')->cascadeOnDelete()->cascadeOnUpdate();
            $table->primary(['user_profile_id', 'trade_id']);
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
