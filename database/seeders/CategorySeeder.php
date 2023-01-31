<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder {
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run () {
		$categories = [
			[
				'id' => 1 ,
				'title' => 'دیجیتال' ,
				'slug' => 'digital' ,
				'is_published' => true ,
				'subCategories' => [
					[
						'title' => 'موبایل' ,
						'slug' => 'mobile' ,
						'is_published' => true,
					] ,
					[
						'title' => 'لب تاپ' ,
						'slug' => 'laptop' ,
						'is_published' => true,
					] ,
				],
			] ,
			[
				'id' => 2 ,
				'title' => 'زیبایی و سلامت' ,
				'slug' => 'beauty and health' ,
				'is_published' => true ,
				'subCategories' => [
					[
						'title' => 'لوازم آرایشی' ,
						'slug' => 'beauty' ,
						'is_published' => true,
					] ,
					[
						'title' => 'مراقبت پوست' ,
						'slug' => 'face-and-body-cream' ,
						'is_published' => true,
					] ,
				],
			],
		];
		foreach ( $categories as $category ) {
			$record = Category::query()
								->updateOrCreate([ 'id' => $category[ 'id' ] ] ,[
									'title' => $category['title'],
									'slug' => $category['slug'],
									'is_published' => $category['is_published'],
								]);
			$record->subCategories()
					 ->createMany($category[ 'subCategories' ]);
		}
	}
}
