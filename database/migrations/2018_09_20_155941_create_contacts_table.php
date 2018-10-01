<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->increments('id');
            $table->char('hashed_id', 16)->nullable();
            $table->integer('address_id')->default(0);
            $table->enum('contact_type', ['Owner', 'Emergency contact'])->nullable()->default('Owner');
            $table->string('first_name', 50)->nullable();
            $table->string('last_name', 50)->nullable();
            $table->string('phone', 50)->nullable();
            $table->string('email', 75)->nullable();
            $table->string('preferred_contact_method', 25)->nullable()->default('email');
            $table->string('relationship', 50)->nullable();
            $table->string('comments', 1000)->nullable();
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
        Schema::dropIfExists('contacts');
    }
}
