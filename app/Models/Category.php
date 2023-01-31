<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Category extends Model implements HasMedia
{
    use HasFactory;
	use SoftDeletes;
	use InteractsWithMedia;
	use LogsActivity;
	
	protected $with = [
		'media'
	];
	
	protected $fillable = [
		'title',
		'slug',
		'link',
		'is_published'
	];
	
	protected $casts = [
		'is_published' => 'boolean',
		'title' => 'string'
	];
	
	public function registerMediaCollections (): void {
		$this->addMediaCollection('category-icon')
			->singleFile();
	}
	
	public function registerMediaConversions ( Media $media = null ): void {
			$this->addMediaConversion('thumb')
				->width(300)
				->height(300);
	}
	
	public function subCategories() {
		return $this->hasMany(SubCategory::class);
	}

	public function getActivitylogOptions (): LogOptions {
		return  LogOptions::defaults()
			->logFillable()
			->useLogName('category');
	}
}
