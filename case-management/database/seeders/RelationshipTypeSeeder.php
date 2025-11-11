<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\RelationshipType;

class RelationshipTypeSeeder extends Seeder
{
    public function run(): void
    {
        $relationshipTypes = [
            ['name' => 'Child', 'inverse' => 'Parent', 'created_by' => 1, 'updated_by' => 1],
            ['name' => 'Family Coach', 'inverse' => null, 'created_by' => 1, 'updated_by' => 1],
            ['name' => 'Family Friend', 'inverse' => null, 'created_by' => 1, 'updated_by' => 1],
            ['name' => 'Guardian', 'inverse' => 'Ward', 'created_by' => 1, 'updated_by' => 1],
            ['name' => 'Ward', 'inverse' => 'Guardian', 'created_by' => 1, 'updated_by' => 1],
            ['name' => 'Other', 'inverse' => null, 'created_by' => 1, 'updated_by' => 1],
            ['name' => 'Parent', 'inverse' => 'Child', 'created_by' => 1, 'updated_by' => 1],
            ['name' => 'Resource Friend', 'inverse' => null, 'created_by' => 1, 'updated_by' => 1],
            ['name' => 'Spouse', 'inverse' => 'Spouse', 'created_by' => 1, 'updated_by' => 1],
            ['name' => 'Aunt', 'inverse' => null, 'created_by' => 1, 'updated_by' => 1],
            ['name' => 'Daughter', 'inverse' => null, 'created_by' => 1, 'updated_by' => 1],
            ['name' => 'Father', 'inverse' => null, 'created_by' => 1, 'updated_by' => 1],
            ['name' => 'Granddaughter', 'inverse' => null, 'created_by' => 1, 'updated_by' => 1],
            ['name' => 'Grandfather', 'inverse' => null, 'created_by' => 1, 'updated_by' => 1],
            ['name' => 'Grandmother', 'inverse' => null, 'created_by' => 1, 'updated_by' => 1],
            ['name' => 'Grandson', 'inverse' => null, 'created_by' => 1, 'updated_by' => 1],
            ['name' => 'Great-Granddaughter', 'inverse' => null, 'created_by' => 1, 'updated_by' => 1],
            ['name' => 'Great-Grandson', 'inverse' => null, 'created_by' => 1, 'updated_by' => 1],
            ['name' => 'Husband', 'inverse' => null, 'created_by' => 1, 'updated_by' => 1],
            ['name' => 'Legal Guardian', 'inverse' => null, 'created_by' => 1, 'updated_by' => 1],
            ['name' => 'Mother', 'inverse' => null, 'created_by' => 1, 'updated_by' => 1],
            ['name' => 'Nephew', 'inverse' => null, 'created_by' => 1, 'updated_by' => 1],
            ['name' => 'Niece', 'inverse' => null, 'created_by' => 1, 'updated_by' => 1],
            ['name' => 'No Biological Relation', 'inverse' => null, 'created_by' => 1, 'updated_by' => 1],
            ['name' => 'Partner', 'inverse' => null, 'created_by' => 1, 'updated_by' => 1],
            ['name' => 'Sibling', 'inverse' => null, 'created_by' => 1, 'updated_by' => 1],
            ['name' => 'Son', 'inverse' => null, 'created_by' => 1, 'updated_by' => 1],
            ['name' => 'Step-Daughter', 'inverse' => null, 'created_by' => 1, 'updated_by' => 1],
            ['name' => 'Step-Father', 'inverse' => null, 'created_by' => 1, 'updated_by' => 1],
            ['name' => 'Step-Mother', 'inverse' => null, 'created_by' => 1, 'updated_by' => 1],
            ['name' => 'Step-Son', 'inverse' => null, 'created_by' => 1, 'updated_by' => 1],
            ['name' => 'Uncle', 'inverse' => null, 'created_by' => 1, 'updated_by' => 1],
            ['name' => 'Unknown', 'inverse' => null, 'created_by' => 1, 'updated_by' => 1],
            ['name' => 'Wife', 'inverse' => null, 'created_by' => 1, 'updated_by' => 1],
        ];

        foreach ($relationshipTypes as $t) {
            $rec = RelationshipType::create(
                [
                    'name' => $t['name'],
                    'created_by' => $t['created_by'],
                    'updated_by' => $t['updated_by'],
                ]
            );
            if ($t['inverse']) {
                $inv = RelationshipType::where('name', $t['inverse'])->first();
                $rec->update(['inverse_type_id' => $inv->id ?? null]);
                if ($inv) $inv->update(['inverse_type_id' => $rec->id]);
            }
        }
    }
}
