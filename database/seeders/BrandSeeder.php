<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder {
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run () {
		$brands = [
			[
				'id' => 1 ,
				'title' => 'Apple' ,
				'slug' => 'Apple' ,
				'is_published' => 1,
			] ,
			[
				'id' => 2 ,
				'title' => 'xiaomi' ,
				'slug' => 'xiaomi' ,
				'is_published' => 0,
			],
		];
		foreach ( $brands as $brand ) {
			Brand::query()
				 ->updateOrCreate([ 'id' => $brand[ 'id' ] ] , $brand);
		}
	}
}
