<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddConsultationFeeToLawyersTable extends Migration
{
    public function up()
    {
        Schema::table('lawyers', function (Blueprint $table) {
            $table->decimal('consultation_fee', 10, 2)->default(5000)->after('profile_image');
        });
    }

    public function down()
    {
        Schema::table('lawyers', function (Blueprint $table) {
            $table->dropColumn('consultation_fee');
        });
    }
}