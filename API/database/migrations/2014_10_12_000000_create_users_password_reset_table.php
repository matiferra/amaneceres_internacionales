<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersPasswordResetTable extends Migration
{

    public function up()
    {
        Schema::create('users_password_resets', function (Blueprint $table) {
            $table->string('email')->index();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });
    }

    
    public function down()
    {
        Schema::dropIfExists('users_password_resets');
    }
}
