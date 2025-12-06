<?php

namespace Database\Seeders;

use App\Models\Nationality;
use Illuminate\Database\Seeder;

class NationalitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $nationalities = [
            ['name' => 'Pakistani'],
            ['name' => 'Indian'],
            ['name' => 'American'],
            ['name' => 'British'],
            ['name' => 'Canadian'],
            ['name' => 'Australian'],
            ['name' => 'Emirati'],
            ['name' => 'Saudi Arabian'],
            ['name' => 'Bangladeshi'],
            ['name' => 'Filipino'],
            ['name' => 'Egyptian'],
            ['name' => 'Jordanian'],
            ['name' => 'Lebanese'],
            ['name' => 'Syrian'],
            ['name' => 'Turkish'],
            ['name' => 'Iranian'],
            ['name' => 'Iraqi'],
            ['name' => 'Yemeni'],
            ['name' => 'Omani'],
            ['name' => 'Kuwaiti'],
            ['name' => 'Qatari'],
            ['name' => 'Bahraini'],
            ['name' => 'Nepalese'],
            ['name' => 'Sri Lankan'],
            ['name' => 'Afghan'],
            ['name' => 'Chinese'],
            ['name' => 'Japanese'],
            ['name' => 'South Korean'],
            ['name' => 'Singaporean'],
            ['name' => 'Malaysian'],
            ['name' => 'Indonesian'],
            ['name' => 'Thai'],
            ['name' => 'Vietnamese'],
            ['name' => 'French'],
            ['name' => 'German'],
            ['name' => 'Italian'],
            ['name' => 'Spanish'],
            ['name' => 'Dutch'],
            ['name' => 'Belgian'],
            ['name' => 'Swiss'],
            ['name' => 'Swedish'],
            ['name' => 'Norwegian'],
            ['name' => 'Danish'],
            ['name' => 'Russian'],
            ['name' => 'Ukrainian'],
            ['name' => 'Polish'],
            ['name' => 'Romanian'],
            ['name' => 'Greek'],
            ['name' => 'Portuguese'],
            ['name' => 'Brazilian'],
            ['name' => 'Argentine'],
            ['name' => 'Mexican'],
            ['name' => 'South African'],
            ['name' => 'Nigerian'],
            ['name' => 'Kenyan'],
            ['name' => 'Ghanaian'],
            ['name' => 'Ethiopian'],
            ['name' => 'Moroccan'],
            ['name' => 'Tunisian'],
            ['name' => 'Algerian'],
            ['name' => 'Sudanese'],
        ];

        foreach ($nationalities as $nationality) {
            Nationality::create($nationality);
        }
    }
}
