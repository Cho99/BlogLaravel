<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAttributePhoneIntoAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::table('admins', function (Blueprint $table) {
        //     //
        //     $table->integer('phone')->after('email')->nullable;
        // });
        // if(Schema::hasTable('admin')) {
        //     Schema::rename('admin', 'admins');
        // }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('admins', function (Blueprint $table) {
            //
            $table->dropColumn('phone');
        });
    }
}
