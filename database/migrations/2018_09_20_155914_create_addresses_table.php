<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->increments('id');
            $table->char('hashed_id', 16)->nullable();
            $table->integer('parent_id')->nullable()->default(0);
            $table->enum('address_type', ['Mailing', 'Physical', 'Winter', 'Emergency'])->nullable()->default('Physical');
            $table->string('address_line_1', 100)->nullable();
            $table->string('address_line_2', 100)->nullable();
            $table->string('address_line_3', 100)->nullable();
            $table->string('city', 100)->nullable();
            $table->string('state', 10)->nullable();
            $table->string('zip', 20)->nullable();
            $table->string('country', 100)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('addresses');
    }
}
