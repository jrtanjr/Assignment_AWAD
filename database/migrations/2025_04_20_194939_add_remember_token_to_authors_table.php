<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRememberTokenToAuthorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('authors', function (Blueprint $table) {
            $table->rememberToken()->after('password')->nullable();
        });
    }
    
    public function down()
    {
        Schema::table('authors', function (Blueprint $table) {
            $table->dropColumn('remember_token');
        });
    }
}
