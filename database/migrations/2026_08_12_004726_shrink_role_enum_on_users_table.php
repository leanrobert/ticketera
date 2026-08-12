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
        DB::table('users')->where('role', 'support')->update(['role' => 'admin']);

        DB::statement("ALTER TABLE users MODIFY COLUMN role ENUM('admin', 'client') NOT NULL DEFAULT 'client'");
    }

    /**
     * Reverse the migrations.
     *
     * This widens the enum back to include 'support', but it cannot know
     * which of the now-admin accounts were originally support — that fact
     * was lost when `up()` promoted them. Accounts stay admin after rollback.
     */
    public function down(): void
    {
        DB::statement("ALTER TABLE users MODIFY COLUMN role ENUM('admin', 'support', 'client') NOT NULL DEFAULT 'client'");
    }
};
