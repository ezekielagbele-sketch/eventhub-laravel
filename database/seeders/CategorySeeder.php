<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;


class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'Technology',
            'Business',
            'Education',
            'Sports',
            'Music',
            'Health',
            'Networking',
            'workshop',
            'Conference',
            'Entertainment',

        ];

        foreach ($categories as $category){

           Category::firstOrCreate([
               'name' => $category,
           ]);
        }
    }
}
