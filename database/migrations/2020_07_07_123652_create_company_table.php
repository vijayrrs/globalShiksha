<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompanyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->string("link");
            $table->integer("industry_id");
            $table->string("class");
            $table->text("description");
            $table->text("age");
            $table->text("registration_number");
            $table->string("status");

            $table->string("cin_no");
            $table->string("category_name");
            $table->string("sub_category_name");
            $table->string("pin");
            $table->string("roc_no");
            $table->text("email_addr");
            $table->text("registered_office");
            $table->text("state");
            $table->string("district");
            $table->string("city");

            $table->string("d_DateOfAppointment");
            $table->string("d_Designation");
            $table->string("d_Name");
            $table->integer("d_No");
            $table->string("d_DateOfAppointment2");
            $table->string("d_Designation2");
            $table->string("d_Name2");
            $table->integer("d_No2");

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('company');
    }
}
