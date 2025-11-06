<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Add generated column (PostgreSQL syntax)
        DB::statement("
            ALTER TABLE persons
            ADD COLUMN full_name VARCHAR(255)
            GENERATED ALWAYS AS (last_name || ', ' || first_name) STORED
        ");

        // Optional: index for searching/sorting
        DB::statement("CREATE INDEX idx_persons_full_name ON persons(full_name)");
    }

    public function down(): void
    {
        DB::statement("DROP INDEX IF EXISTS idx_persons_full_name");
        DB::statement("ALTER TABLE persons DROP COLUMN full_name");
    }
};
