<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateUsersTable extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('mobile')->nullable()->after('email');
            $table->string('city')->nullable()->after('mobile');
            $table->enum('user_type', ['customer', 'lawyer', 'admin'])->default('customer')->after('city');
            $table->enum('status', ['active', 'inactive', 'banned'])->default('active')->after('user_type');
            $table->string('profile_image')->nullable()->after('status');
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['mobile', 'city', 'user_type', 'status', 'profile_image']);
        });
    }
}