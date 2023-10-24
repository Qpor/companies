<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateProtectCompanyFoundationDateTrigger extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('CREATE TRIGGER `PROTECT_COMPANY_FOUNDATION_DATE` BEFORE UPDATE ON `companies` FOR EACH ROW BEGIN IF NEW.company_foundation_date IS NOT NULL THEN SET NEW.company_foundation_date = OLD.company_foundation_date; END IF; END');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('DROP TRIGGER `PROTECT_COMPANY_FOUNDATION_DATE`');
    }
}
