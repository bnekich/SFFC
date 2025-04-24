<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tag;

class TagSeeder extends Seeder
{
    public function run(): void
    {
        $tags = [
            'Contact Type - Email or Text',
            'Contact Type - Fidelity Monthly Review',
            'Contact Type - In Person',
            'Contact Type - Phone',
            'Contact Type - Virtual',
            'Contact Type - Other',
            'In Regard to - Child',
            'In Regard to - Collateral Contact or Service Provider',
            'In Regard to - Family Coach',
            'In Regard to - Family Friend',
            'In Regard to - Host Family',
            'In Regard to - Parent',
            'In Regard to - Referral Family',
            'In Regard to - Secondary Host Family',
            'Subject - Change in Family Situation/housing, employment, etc.',
            'Subject - Child Moved to Another Host Home',
            'Subject - Concerns Identified (Red Flag)',
            'Subject - Discussion Around or Completion of PFS-2',
            'Subject - Discussion of Ongoing, Long-Term Relationship',
            'Subject - Family Goals',
            'Subject - Home Visit Details',
            'Subject - Intake Information',
            'Subject - Other Support Service for Parent',
            'Subject - Other Support Service for Volunteer',
            'Subject - Parent/Child Relationship',
            'Subject - Parent/Family Visit Details',
            'Subject - Positive Observations Towards Goals',
            'Subject - Relationship Building with Parent(s)/Guardian(s) Supported',
            'Subject - Resources Provided',
            'Subject - Supervision Note',
            'Subject - Supervisor Close Review',
            'Subject - Supervisor Open Review',
            'Subject - Other',
        ];

        foreach ($tags as $tag) {
            Tag::create([
                'name' => $tag,
            ]);
        }
    }
}
