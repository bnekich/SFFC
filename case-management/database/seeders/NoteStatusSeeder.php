<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\NoteStatus;

class NoteStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $noteStatuses = ['Draft', 'Pending', 'Approved'];
        foreach ($noteStatuses as $status)
            NoteStatus::create(['name' => $status]);
    }
}
