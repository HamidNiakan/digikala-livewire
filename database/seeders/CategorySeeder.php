<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories= [
			[
				'id' => 1,
				'title' => 'دیجیتال',
				'slug' => 'digital',
				'is_published' => true
			],
			[
				'id' => 2,
				'title' => 'زیبایی و سلامت',
				'slug' => 'beauty and health',
				'is_published' => true
			]
		];
		
		foreach ($categories as $category) {
			Category::query()
				->updateOrCreate(['id' => $category['id']],$category);
		}
    }
}
