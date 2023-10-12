<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoryWishSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (range(0,20) as $id) {
            DB::table('category_wish')->insert([
                'category_id' => random_int(1, 7),
                'wish_id' => random_int(1, 20)
            ]);
        }
    }
}
