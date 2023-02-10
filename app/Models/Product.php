<?php

namespace App\Models;

use App\Enums\ProductQuality;
use App\Enums\ProductStatus;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Product extends Model implements HasMedia {
	use HasFactory;
	use SoftDeletes;
	use Sluggable;
	use LogsActivity;
	use InteractsWithMedia;
	
	protected $guarded = [];
	
	public function registerMediaCollections (): void {
		$this->addMediaCollection('product-image')
			 ->singleFile();
	}
	
	public function registerMediaConversions ( Media $media = null ): void {
		$this->addMediaConversion('thumb')
			 ->width(300)
			 ->height(300);
	}
	
	protected $casts = [
		'status' => ProductStatus::class ,
		'type_of_quality' => ProductQuality::class ,
	];
	
	public function category () {
		return $this->belongsTo(Category::class);
	}
	
	public function subCategory () {
		return $this->belongsTo(SubCategory::class);
	}
	
	public function childCategory () {
		return $this->belongsTo(ChildCategory::class);
	}
	
	public function sluggable (): array {
		return [
			'slug' => [
				'source' => [
					'title' ,
					'id' ,
				] ,
			] ,
		];
	}
	
	public function getActivitylogOptions (): LogOptions {
		LogOptions::defaults()
				  ->logUnguarded()
				  ->useLogName('product');
	}
}
