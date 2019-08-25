<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInitialTableSchema extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function ($table) {
            $table->string('company');
            $table->string('country');
            $table->integer('role_id')->nullable();
            $table->string('user_type', 250)->default('Client');
            $table->string('profileimage');
        	$table->string('coverpic_image', 250);
        	$table->tinyInteger('status')->default(1);
            $table->tinyInteger('isonline')->default(1);
            $table->softDeletes();
        });  

        Schema::create('cmspages', function($table){
            $table->bigIncrements('pageId');
            $table->string('identifier');
            $table->string('title', 250);
            $table->text('content');
            $table->timestamps();
            $table->smallInteger('visible')->default(1);
            $table->softDeletes();
        });

        Schema::create('country', function($table){
            $table->bigIncrements('countryId');
            $table->string('code', 100);
            $table->string('name', 250);
            $table->timestamps();
            $table->tinyInteger('visible')->default(1);
            $table->softDeletes();
        });

        Schema::create('roles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('display_name');
            $table->text('description')->nullable();
            $table->boolean('status')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('permissions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('display_name');
            $table->text('description')->nullable();
            $table->string('resource');
            $table->boolean('is_common');
            $table->softDeletes();
        });

        Schema::create('permission_role', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('role_id');
            $table->integer('permission_id');
            $table->boolean('status')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('user_activities', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->integer('user_id');
            $table->text('activity')->nullable();
            $table->tinyInteger('visible');
            $table->softDeletes();
            $table->tinyInteger('is_notification')->default(1);
            $table->tinyInteger('is_viwed')->default(0);
        });

        Schema::create('plans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id')->nullable();
            $table->boolean('is_default');
            $table->boolean('active');
            $table->dateTime('expireDate')->nullable();
            $table->text('planDescription')->nullable();
            $table->integer('created_by')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('core_config', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('key');
            $table->string('field');
            $table->text('value')->nullable();
            $table->softDeletes();
            $table->timestamps();
            $table->tinyInteger('visible')->default(1);
        });

        Schema::create('email_templates', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('identifier');
            $table->string('title');
            $table->text('content');
            $table->softDeletes();
            $table->timestamps();
            $table->tinyInteger('visible')->default(1);
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
        Schema::dropIfExists('cmspages');
        Schema::dropIfExists('country');
        Schema::dropIfExists('roles');
        Schema::dropIfExists('permissions');
        Schema::dropIfExists('permission_role');
        Schema::dropIfExists('user_activities');
        Schema::dropIfExists('plans');
        Schema::dropIfExists('core_config');
        Schema::dropIfExists('email_templates');
    }
}
