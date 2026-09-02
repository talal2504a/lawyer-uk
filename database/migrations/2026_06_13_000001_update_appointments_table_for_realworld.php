<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('appointments', function (Blueprint $table) {
            $table->string('city')->nullable()->after('lawyer_id');
            $table->string('case_type')->nullable()->after('city');
            $table->string('budget')->nullable()->after('case_type');
            $table->string('attachment_path')->nullable()->after('budget');
            
            // Scheduling/Meeting details
            $table->string('meeting_mode')->nullable()->after('status'); // In-Person, Video Call, Phone Call
            $table->string('meeting_location')->nullable()->after('meeting_mode');
            
            // Payments
            $table->decimal('consultation_fee', 10, 2)->nullable()->after('meeting_location');
            $table->decimal('advance_required', 10, 2)->nullable()->after('consultation_fee');
            
            // Rejection Details
            $table->text('rejection_reason')->nullable()->after('advance_required');
            $table->foreignId('suggested_lawyer_id')->nullable()->after('rejection_reason')->constrained('users')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::table('appointments', function (Blueprint $table) {
            $table->dropForeign(['suggested_lawyer_id']);
            $table->dropColumn([
                'city', 'case_type', 'budget', 'attachment_path', 'meeting_mode', 
                'meeting_location', 'consultation_fee', 'advance_required', 'rejection_reason', 'suggested_lawyer_id'
            ]);
        });
    }
};
