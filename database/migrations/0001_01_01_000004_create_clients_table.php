<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->foreignId('created_by')->constrained('users')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('name', 50)->nullable();
            $table->string('dba', 50)->nullable();
            $table->string('abbreviation', 10)->nullable();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('client_onboardings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('created_by')->constrained('users')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('client_id')->constrained('clients')->cascadeOnDelete()->cascadeOnUpdate();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->text('notes')->nullable();
            $table->foreignId('payment_term_id')->nullable()->constrained('payment_terms')->cascadeOnDelete()->cascadeOnUpdate();
            $table->boolean('completed')->default(false);
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('client_contracts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('created_by')->constrained('users')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('client_id')->constrained('clients')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('contract_number', 20)->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->foreignId('payment_term_id')->nullable()->constrained('payment_terms')->cascadeOnDelete()->cascadeOnUpdate();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('client_service_charges', function (Blueprint $table) {
            $table->id();
            $table->foreignId('created_by')->constrained('users')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('client_id')->constrained('clients')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('type')->nullable();
            $table->decimal('amount', 10, 2)->nullable();
            $table->decimal('percent', 10, 2)->nullable();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('client_contacts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('created_by')->constrained('users')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('client_id')->constrained('clients')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('first_name', 50)->nullable();
            $table->string('last_name', 50)->nullable();
            $table->string('email', 100)->nullable();
            $table->string('phone', 20)->nullable();
            $table->string('phone_extension', 20)->nullable();
            $table->string('position', 50)->nullable();
            $table->boolean('primary')->default(false);
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('client_calls', function (Blueprint $table) {
            $table->id();
            $table->foreignId('created_by')->constrained('users')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('client_id')->constrained('clients')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('client_contact_id')->nullable()->constrained('client_contacts')->cascadeOnDelete()->cascadeOnUpdate();
            $table->dateTime('call_date')->nullable();
            $table->text('notes')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('client_notes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('created_by')->constrained('users')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('client_id')->constrained('clients')->cascadeOnDelete()->cascadeOnUpdate();
            $table->text('note')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('client_billing_instructions', function (Blueprint $table) {
            $table->foreignId('client_id')->constrained('clients')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('created_by')->constrained('users')->cascadeOnDelete()->cascadeOnUpdate();
            $table->text('instructions')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('client_rate', function (Blueprint $table) {
            $table->id();
            $table->foreignId('created_by')->constrained('users')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('client_id')->constrained('clients')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('title', 50)->default('Standard');
            $table->boolean('default')->default(false);
            $table->decimal('standard_assessment')->default(0);
            $table->decimal('emergency_assessment')->default(0);
            $table->decimal('overtime_assessment')->default(0);
            $table->decimal('saturday_assessment')->default(0);
            $table->decimal('sunday_assessment')->default(0);
            $table->decimal('holiday_assessment')->default(0);
            $table->decimal('standard_trip')->default(0);
            $table->decimal('standard_hour')->default(0);
            $table->decimal('emergency_trip')->default(0);
            $table->decimal('emergency_hour')->default(0);
            $table->decimal('overtime_trip')->default(0);
            $table->decimal('overtime_hour')->default(0);
            $table->decimal('saturday_trip')->default(0);
            $table->decimal('saturday_hour')->default(0);
            $table->decimal('sunday_trip')->default(0);
            $table->decimal('sunday_hour')->default(0);
            $table->decimal('holiday_trip')->default(0);
            $table->decimal('holiday_hour')->default(0);
            $table->string('custom_field_1_description', 50)->default(0);
            $table->decimal('custom_field_1_amount')->default(0);
            $table->string('custom_field_2_description', 50)->default(0);
            $table->decimal('custom_field_2_amount')->default(0);
            $table->string('custom_field_3_description', 50)->default(0);
            $table->decimal('custom_field_3_amount')->default(0);
            $table->string('custom_field_4_description', 50)->default(0);
            $table->decimal('custom_field_4_amount')->default(0);
            $table->string('custom_field_5_description', 50)->default(0);
            $table->decimal('custom_field_5_amount')->default(0);
            $table->string('custom_field_6_description', 50)->default(0);
            $table->decimal('custom_field_6_amount')->default(0);
            $table->string('custom_field_7_description', 50)->default(0);
            $table->decimal('custom_field_7_amount')->default(0);
            $table->string('custom_field_8_description', 50)->default(0);
            $table->decimal('custom_field_8_amount')->default(0);
            $table->string('custom_field_9_description', 50)->default(0);
            $table->decimal('custom_field_9_amount')->default(0);
            $table->string('custom_field_10_description', 50)->default(0);
            $table->decimal('custom_field_10_amount')->default(0);
            $table->boolean('active')->default(false);
            $table->date('start_date')->default(now());
            $table->date('end_date')->default(now()->add('1 year'));
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('client_portals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('created_by')->constrained('users')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('client_id')->constrained('clients')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('name', 50);
            $table->string('description', 500)->nullable();
            $table->string('url', 255);
            $table->string('username');
            $table->string('password');
            $table->boolean('general_portal')->default(false);
            $table->boolean('invoicing_only')->default(false);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};
