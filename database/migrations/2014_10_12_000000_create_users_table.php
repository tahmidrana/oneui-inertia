<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('userid', 50)->unique();
            $table->string('email')->nullable();
            $table->tinyInteger('gender')->nullable()->comment('1 - Male, 2 - Female, 3 - Other');
            $table->date('dob')->nullable();
            $table->string('blood_group')->nullable();
            $table->string('address')->nullable();
            $table->string('post_code')->nullable();
            $table->string('phone', 100)->nullable();
            $table->string('photo')->nullable();

            $table->string('em_contact_name')->nullable()->comment('Emergency contact details');
            $table->string('em_contact_relation')->nullable();
            $table->string('em_contact_phone')->nullable();
            $table->string('em_contact_email')->nullable();

            $table->date('joining_date')->nullable();
            $table->string('last_educational_qual')->nullable();
            $table->boolean('is_clinician')->default(false);
            $table->unsignedSmallInteger('clinician_type')->nullable()->comment('1 - Counselor, 2 - Psychiatrist');
            $table->unsignedInteger('supervisor_id')->nullable()->comment('Foreign Key: `users - id`');
            $table->unsignedSmallInteger('employment_type')->default(1)
                ->comment('1 - Permanent, 2 - Part time, 3 - Contractual');

            $table->boolean('is_active')->default(true);
            $table->boolean('is_superuser')->default(false);
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
