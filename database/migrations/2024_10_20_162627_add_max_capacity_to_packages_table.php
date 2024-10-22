<?php
// database/migrations/xxxx_xx_xx_xxxxxx_add_max_capacity_to_packages_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMaxCapacityToPackagesTable extends Migration
{
    public function up()
    {
        Schema::table('packages', function (Blueprint $table) {
            $table->integer('max_capacity')->default(0); // Add the max_capacity column
        });
    }

    public function down()
    {
        Schema::table('packages', function (Blueprint $table) {
            $table->dropColumn('max_capacity'); // Drop the column if necessary
        });
    }
}
