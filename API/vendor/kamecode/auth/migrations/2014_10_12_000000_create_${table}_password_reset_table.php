<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create${migrationName}PasswordResetTable extends Migration
{

    public function up()
    {
        Schema::create('${table}_password_resets', function (Blueprint $table) {
            $table->string('email')->index();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });
    }

    
    public function down()
    {
        Schema::dropIfExists('${table}_password_resets');
    }
}
