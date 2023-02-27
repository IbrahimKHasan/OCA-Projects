<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->id('company_id');
            $table->unsignedBigInteger('user_id');
            $table->string('company_name');
            $table->string('company_email');
            $table->string('company_phone');
            $table->text('company_description');
            $table->string('company_location');
            $table->integer('bedroom_price');
            $table->integer('livingroom_price');
            $table->integer('guestroom_price');
            $table->integer('kitchen_price');
            $table->integer('km_price');
            $table->integer('pack_price');
            $table->integer('company_bookings_count')->default(0);
            $table->float('company_rate')->default(0);
            $table->integer('company_rate_count')->default(0);
            $table->string('status')->default('Available');
            $table->text('company_image');
            $table->timestamps();
        });

        Schema::table('companies', function (Blueprint $table) {
            $table->foreign('user_id')
            ->references('id')
            ->on('users')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('companies');
    }
}
