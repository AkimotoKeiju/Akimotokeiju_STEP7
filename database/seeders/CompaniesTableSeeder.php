<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CompaniesTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('companies')->insert([
            [
                'company_name' => 'コカ・コーラ',
                'street_address' => '東京都港区赤坂',
                'representative_name' => 'ジェームズ・クインシー',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'company_name' => 'サントリー',
                'street_address' => '大阪府大阪市北区',
                'representative_name' => '鳥井信宏',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'company_name' => 'キリン',
                'street_address' => '東京都中野区',
                'representative_name' => '磯崎功典',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}