<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('meeting_locations', function (Blueprint $table) {
            $table->dropUnique('meeting_locations_description_unique'); // Drop the old unique constraint
            $table->unique(['corporation_id', 'description'], 'meeting_locations_corporation_description_unique'); // Add new unique constraint
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('meeting_locations', function (Blueprint $table) {
            $table->dropUnique('meeting_locations_corporation_description_unique'); // Drop the new composite unique constraint
            $table->unique('description', 'meeting_locations_description_unique'); // Restore the original unique constraint
        });
    }
};