<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('infants', function (Blueprint $table) {
            $table->increments('id');
            $table->string('first_name', 50);
            $table->string('last_name');
            $table->date('dob');
            $table->timestamps();
        });

        DB::table('infants')->insert([
            'first_name' => 'Tran',
            'last_name'=>'Ha Bao',
            'dob'=>'2021-08-11'
        ]);
        DB::table('infants')->insert([
            'first_name' => 'Nhut',
            'last_name'=>'Vo Minh',
            'dob'=>'2021-03-18'
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('infants');
    }
};
