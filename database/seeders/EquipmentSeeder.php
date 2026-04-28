<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class EquipmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
   public function run(): void
{
    DB::table('equipment')->insert([
        [
            'name' => 'Blood Sword',
            'category' => 'Blades',
            'description' => 'Forged in crimson fire, sharp and deadly.',
            'stats' => json_encode(['strength' => 15, 'speed' => 5]),
            'status' => 'available',
        ],
        [
    'name' => 'Shadow Dagger',
    'category' => 'Blades',
    'description' => 'A dagger forged in darkness.',
    'stats' => json_encode(['strength' => 8, 'speed' => 12]),
    'status' => 'available',
],
        [
            'name' => 'Star Spear',
            'category' => 'Blades',
            'description' => 'A spear tipped with starlight.',
            'stats' => json_encode(['strength' => 10, 'magic' => 8]),
            'status' => 'available',
        ],
        [
            'name' => 'Fire Elements Codex',
            'category' => 'Books',
            'description' => 'Ancient tome of flame spells.',
            'stats' => json_encode(['magic' => 12, 'wisdom' => 7]),
            'status' => 'available',
        ],
        [
            'name' => 'Ice Codex',
            'category' => 'Books',
            'description' => 'Frozen knowledge bound in runes.',
            'stats' => json_encode(['magic' => 10, 'defense' => 5]),
            'status' => 'available',
        ],
        [
            'name' => 'Arcane Rod',
            'category' => 'Magic Staffs',
            'description' => 'Channeler of pure arcane energy.',
            'stats' => json_encode(['magic' => 15, 'speed' => 3]),
            'status' => 'available',
        ],
        [
            'name' => 'Stormcaller',
            'category' => 'Magic Staffs',
            'description' => 'Summons thunder and lightning.',
            'stats' => json_encode(['magic' => 14, 'strength' => 4]),
            'status' => 'available',
        ],
        [
            'name' => 'Dragonhide Vest',
            'category' => 'Armors',
            'description' => 'Light armor made from dragon scales.',
            'stats' => json_encode(['defense' => 12, 'speed' => 6]),
            'status' => 'available',
        ],
        [
            'name' => 'Iron Plate',
            'category' => 'Armors',
            'description' => 'Heavy armor, sturdy and reliable.',
            'stats' => json_encode(['defense' => 15, 'strength' => 5]),
            'status' => 'available',
        ],
    ]);
}

}
