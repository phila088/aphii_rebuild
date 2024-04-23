<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusCodeSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('status_codes')->insert([
            ['for_model' => 'Client', 'code' => 'ACTIVE', 'description' => 'Client is active.'],
            ['for_model' => 'Client', 'code' => 'DNUXXX', 'description' => 'Do not use this client.'],
            ['for_model' => 'Client', 'code' => 'INACTV', 'description' => 'Client is inactive.'],
            ['for_model' => 'Client', 'code' => 'ONBRDG', 'description' => 'Onboarding client.'],
            ['for_model' => 'WorkOrderVendorClock', 'code' => 'RETTND', 'description' => 'Return trip needed.'],
            ['for_model' => 'WorkOrderVendorClock', 'code' => 'ONSITE', 'description' => 'Onsite.'],
            ['for_model' => 'WorkOrderVendorClock', 'code' => 'COMPLE', 'description' => 'Completed.'],
            ['for_model' => 'WorkOrderVendorClock', 'code' => 'PVNDQT', 'description' => 'Pending vendor quote.'],
            ['for_model' => 'WorkOrder', 'code' => 'ACCEPT', 'description' => 'Work order accepted.'],
            ['for_model' => 'WorkOrder', 'code' => 'PNDSCH', 'description' => 'Pending scheduling.'],
            ['for_model' => 'WorkOrder', 'code' => 'DISPAT', 'description' => 'Dispatched to vendor.'],
            ['for_model' => 'WorkOrder', 'code' => 'DISPCN', 'description' => 'Dispatch confirmed.'],
            ['for_model' => 'WorkOrder', 'code' => 'ONHOLD', 'description' => 'Client placed on hold.'],
            ['for_model' => 'WorkOrder', 'code' => 'ONSITE', 'description' => 'Onsite.'],
            ['for_model' => 'WorkOrder', 'code' => 'ENROUT', 'description' => 'Enroute.'],
            ['for_model' => 'WorkOrder', 'code' => 'PDATFQ', 'description' => 'Pending after the fact quote.'],
            ['for_model' => 'WorkOrder', 'code' => 'PVNDQT', 'description' => 'Pending vendor quote.'],
            ['for_model' => 'WorkOrder', 'code' => 'PNDQUO', 'description' => 'Pending quote to client.'],
            ['for_model' => 'WorkOrder', 'code' => 'QAPSCH', 'description' => 'Quote approved, pending scheduling'],
            ['for_model' => 'WorkOrder', 'code' => 'QADISP', 'description' => 'Quote approved, dispatched'],
            ['for_model' => 'WorkOrder', 'code' => 'QADSPC', 'description' => 'Quote approved, dispatch confirmed'],
            ['for_model' => 'WorkOrder', 'code' => 'QARESC', 'description' => 'Quote approved, reschedule'],
            ['for_model' => 'WorkOrder', 'code' => 'QTREVN', 'description' => 'Quote revision needed.'],
            ['for_model' => 'WorkOrder', 'code' => 'QUOTES', 'description' => 'Quote submitted to client'],
            ['for_model' => 'WorkOrder', 'code' => 'QTSAGN', 'description' => 'Quote submitted, aging.'],
            ['for_model' => 'WorkOrder', 'code' => 'REASIG', 'description' => 'Client reassigned, closed.'],
            ['for_model' => 'WorkOrder', 'code' => 'RECALL', 'description' => 'Client recalled.'],
            ['for_model' => 'WorkOrder', 'code' => 'REJCTD', 'description' => 'Work order rejected.'],
            ['for_model' => 'WorkOrder', 'code' => 'RESCHD', 'description' => 'Reschedule needed.'],
            ['for_model' => 'WorkOrder', 'code' => 'WTOMAT', 'description' => 'Waiting on material.'],
        ]);
    }
}
