<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement("ALTER TABLE tickets MODIFY COLUMN priority ENUM('low', 'medium', 'high', 'urgent') NOT NULL DEFAULT 'low'");
    }

    /**
     * Reverse the migrations.
     *
     * Safe immediately after deploy (no 'urgent' rows exist yet), but if run
     * later against a database that already has urgent tickets, MySQL will
     * reject or truncate those rows depending on sql_mode.
     */
    public function down(): void
    {
        DB::statement("ALTER TABLE tickets MODIFY COLUMN priority ENUM('low', 'medium', 'high') NOT NULL DEFAULT 'low'");
    }
};
