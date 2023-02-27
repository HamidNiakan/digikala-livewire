<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Brand extends Model implements HasMedia {
	use HasFactory;
	use SoftDeletes;
	use InteractsWithMedia;
	use Sluggable;
	use LogsActivity;
	
	protected $fillable = [
		'title' ,
		'slug' ,
		'is_published' ,
		'category_id'
	];
	
	public function registerMediaCollections (): void {
		$this->addMediaCollection(__('messages.brand.media-collection'))
			 ->singleFile();
	}
	
	public function registerMediaConversions ( Media $media = null ): void {
		$this->addMediaConversion('thumb')
			 ->width(300)
			 ->height(300);
	}
	
	public function scopeTrashCount ( Builder $builder ): int {
		return $builder->onlyTrashed()
					   ->count();
	}
	
	public function category() {
		return $this->belongsTo(Category::class);
	}
	
	public function sluggable (): array {
		return [
			'slug' => [
				'source' => [
					'title' ,
					'id' ,
				] ,
				'onUpdate' => true,
			] ,
		];
	}
	
	public function getActivitylogOptions (): LogOptions {
		return LogOptions::defaults()
						 ->logFillable()
						 ->useLogName(__('messages.brand.log-name'));
	}
}
