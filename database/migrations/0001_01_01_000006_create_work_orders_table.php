<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('work_order_priorities', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('code');
            $table->integer('hours_to_onsite');
            $table->integer('hours_to_quote');
            $table->integer('hours_to_return');
            $table->integer('hours_to_complete');
            $table->boolean('emergency')->default(false);
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('work_orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('company_id')->constrained('companies')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('client_id')->constrained('clients')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('external_work_order_number');
            $table->string('internal_work_order_number');
            $table->foreignId('work_order_priority_id')->constrained('work_order_priorities')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('trade_id')->constrained('trades')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('description');
            $table->foreignId('client_location_id')->nullable()->constrained('client_locations')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('location_name', 50);
            $table->string('location_building_number', 50)->nullable();
            $table->string('location_pre_direction', 50)->nullable();
            $table->string('location_street_name', 50)->nullable();
            $table->string('location_street_type', 50)->nullable();
            $table->string('location_post_direction', 50)->nullable();
            $table->string('location_unit_type', 50)->nullable();
            $table->string('location_unit', 50)->nullable();
            $table->string('location_city', 50)->nullable();
            $table->string('location_state', 50)->nullable();
            $table->string('location_zip', 50)->nullable();
            $table->string('location_person_of_contact_first_name', 50)->nullable();
            $table->string('location_person_of_contact_last_name', 50)->nullable();
            $table->string('location_person_of_contact_phone', 50)->nullable();
            $table->string('location_person_of_contact_phone_extension', 50)->nullable();
            $table->string('location_person_of_contact_email', 50)->nullable();
            $table->string('location_special_instructions')->nullable();
            $table->time('location_monday_open')->nullable();
            $table->time('location_monday_close')->nullable();
            $table->time('location_tuesday_open')->nullable();
            $table->time('location_tuesday_close')->nullable();
            $table->time('location_wednesday_open')->nullable();
            $table->time('location_wednesday_close')->nullable();
            $table->time('location_thursday_open')->nullable();
            $table->time('location_thursday_close')->nullable();
            $table->time('location_friday_open')->nullable();
            $table->time('location_friday_close')->nullable();
            $table->time('location_saturday_open')->nullable();
            $table->time('location_saturday_close')->nullable();
            $table->time('location_sunday_open')->nullable();
            $table->time('location_sunday_close')->nullable();
            $table->string('client_special_instructions')->nullable();
            $table->string('client_ivr_account')->nullable();
            $table->string('client_ivr_pin')->nullable();
            $table->string('client_ivr_tracking_number')->nullable();
            $table->timestamps();
        });

        Schema::create('work_order_dnes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('work_order_id')->constrained('work_orders')->cascadeOnDelete()->cascadeOnUpdate();
            $table->decimal('dne');
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('work_order_notes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('work_order_id')->constrained('work_orders')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('note');
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('work_order_schedules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('work_order_id')->constrained('work_orders')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('vendor_id')->nullable()->constrained('vendors')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('company_name', 50)->nullable();
            $table->string('person_of_contact_first_name', 50)->nullable();
            $table->string('person_of_contact_last_name', 50)->nullable();
            $table->string('person_of_contact_phone', 50)->nullable();
            $table->string('person_of_contact_phone_extension', 50)->nullable();
            $table->string('person_of_contact_email', 50)->nullable();
            $table->foreignId('payment_term_id')->nullable()->constrained('payment_terms')->cascadeOnDelete()->cascadeOnUpdate();
            $table->datetime('eta');
            $table->string('dne');
            $table->boolean('accepted')->default(false);
            $table->string('note')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('work_order_vendor_questionnaire', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('work_order_id')->constrained('work_orders')->cascadeOnDelete()->cascadeOnUpdate();
            $table->decimal('incurred')->nullable();
            $table->string('current_findings')->nullable();
            $table->string('repair_plans')->nullable();
            $table->boolean('before_pictures_provided')->nullable();
            $table->string('managers_name')->nullable();
            $table->integer('technicians_onsite')->default(0);
            $table->boolean('can_work_be_completed_today')->default(false);
            $table->integer('hours_to_complete')->default(0);
            $table->string('electrical_is_it_lighting')->nullable();
            $table->string('electrical_lights_in_ceiling')->nullable();
            $table->string('electrical_ladder_or_lift_required')->nullable();
            $table->string('electrical_wiring_required')->nullable();
            $table->string('electrical_model_numbers')->nullable();
            $table->string('hvac_unit_label')->nullable();
            $table->boolean('hvac_asset_sheet_completed')->default(false);
            $table->string('hvac_refrigerant_type');
            $table->string('hvac_pounds_of_refrigerant_required')->nullable();
            $table->string('hvac_model_numbers')->nullable();
            $table->string('hvac_lead_times')->nullable();
            $table->string('hvac_equipment_required')->nullable();
            $table->string('general_specs_for_paint')->nullable();
            $table->string('general_measurements')->nullable();
            $table->string('general_material_quantities');
            $table->string('general_list_of_parts_or_materials')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('work_order_vendor_assignments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('work_order_id')->constrained('work_orders')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('vendor_id')->nullable()->constrained('vendors')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('company_name', 50)->nullable();
            $table->string('person_of_contact_first_name', 50)->nullable();
            $table->string('person_of_contact_last_name', 50)->nullable();
            $table->string('person_of_contact_phone', 50)->nullable();
            $table->string('person_of_contact_phone_extension', 50)->nullable();
            $table->string('person_of_contact_email', 50)->nullable();
            $table->foreignId('payment_term_id')->constrained('payment_terms')->cascadeOnDelete()->cascadeOnUpdate();
            $table->decimal('assessment_charge');
            $table->decimal('trip_charge');
            $table->decimal('hourly_charge');
            $table->decimal('incurred');
            $table->decimal('dne');
            $table->dateTime('eta');
            $table->string('tech_first_name', 50)->nullable();
            $table->string('tech_last_name', 50)->nullable();
            $table->string('tech_phone', 50)->nullable();
            $table->string('tech_phone_extension', 50)->nullable();
            $table->string('tech_email', 50)->nullable();
            $table->boolean('coi');
            $table->boolean('w9');
            $table->boolean('before_pictures');
            $table->boolean('after_pictures');
            $table->boolean('sign_off');
            $table->boolean('invoice');
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('work_order_vendor_dnes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('work_order_id')->constrained('work_orders')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('vendor_id')->nullable()->constrained('vendors')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('work_order_vendor_assignment_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->decimal('dne');
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('work_order_vendor_clocks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('work_order_id')->constrained('work_orders')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('vendor_id')->nullable()->constrained('vendors')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('work_order_vendor_assignment_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->dateTime('clock_in')->nullable();
            $table->dateTime('clock_out')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('work_orders');
    }
};
