<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::table('workshops', function (Blueprint $table) {

            if (!Schema::hasColumn('workshops', 'content')) {
                $table->text('content')->nullable()->after('category');
            }


            if (!Schema::hasColumn('workshops', 'type')) {
                $table->string('type')->default('workshop')->after('content');
            }


            if (!Schema::hasColumn('workshops', 'status')) {
                $table->string('status')->default('planned')->after('type');
            }
        });
    }

    public function down(): void
    {
        Schema::table('workshops', function (Blueprint $table) {
            $table->dropColumn(['content', 'type', 'status']);
        });
    }
};
