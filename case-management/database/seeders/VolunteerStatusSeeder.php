<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\VolunteerStatus;


class VolunteerStatusSeeder extends Seeder
{
    public function run()
    {
        $volunteerStatuses = ['New', 'On Boarding', 'Approved', 'Inactive'];

        foreach ($volunteerStatuses as $status)
            VolunteerStatus::create(['name' => $status]);
    }
}
