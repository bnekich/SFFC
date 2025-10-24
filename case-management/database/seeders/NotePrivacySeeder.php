<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\NotePrivacy;

class NotePrivacySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $notePrivacies = ['Private', 'Public', 'Team Only'];
        foreach ($notePrivacies as $notePrivacy)
            NotePrivacy::create(['name' => $notePrivacy]);
    }
}
