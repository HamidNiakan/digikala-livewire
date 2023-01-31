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

class ChildCategory extends Model implements HasMedia {
	use HasFactory;
	use SoftDeletes;
	use InteractsWithMedia;
	use LogsActivity;
	
	protected $fillable = [
		'title' ,
		'slug' ,
		'link' ,
		'sub_category_id' ,
	];
	protected $casts    = [
		'is_published' => 'boolean' ,
	];
	
	public function registerMediaCollections (): void {
		$this->addMediaCollection('childCategory-icon')
			 ->singleFile();
	}
	
	public function registerMediaConversions ( Media $media = null ): void {
		$this->addMediaConversion('thumb')
			 ->width(300)
			 ->height(300);
	}
	
	public function subCategory () {
		return $this->belongsTo(SubCategory::class);
	}
	
	public function getActivitylogOptions (): LogOptions {
		return LogOptions::defaults()
						 ->logFillable()
						 ->useLogName('child-category');
	}
}
