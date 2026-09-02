<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('lawyers', function (Blueprint $table) {
            $table->string('title')->nullable()->after('specialization');
            $table->string('education')->nullable()->after('experience');
            $table->decimal('rating', 3, 2)->default(4.9)->after('profile_image');
            $table->integer('reviews_count')->default(140)->after('rating');
            $table->string('address')->nullable()->after('reviews_count');
            $table->string('phone')->nullable()->after('address');
            $table->string('email_contact')->nullable()->after('phone');
            $table->string('website')->nullable()->after('email_contact');
            $table->integer('consultation_duration')->default(45)->after('consultation_fee');
            $table->boolean('has_discount')->default(true)->after('consultation_duration');
            $table->boolean('is_verified')->default(true)->after('is_approved');
        });
    }

    public function down()
    {
        Schema::table('lawyers', function (Blueprint $table) {
            $table->dropColumn([
                'title', 'education', 'rating', 'reviews_count', 'address', 'phone', 
                'email_contact', 'website', 'consultation_duration', 'has_discount', 'is_verified'
            ]);
        });
    }
};
