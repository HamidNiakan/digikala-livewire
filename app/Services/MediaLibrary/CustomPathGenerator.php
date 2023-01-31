<?php

namespace App\Services\MediaLibrary;

use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\MediaLibrary\Support\PathGenerator\PathGenerator;
use ReflectionClass;

class CustomPathGenerator implements PathGenerator {
	public function getPath ( Media $media ): string {
		try {
			$reflection = new ReflectionClass($media->model_type);
			return strtolower($reflection->getShortName()) . '/' . $media->id . '/';
		}
		catch ( \ReflectionException ) {
			return $media->id . '/';
		}
	}
	
	public function getPathForConversions ( Media $media ): string {
		return $this->getPath($media) . 'conversions/';
	}
	
	public function getPathForResponsiveImages ( Media $media ): string {
		return $this->getPath($media) . 'responsive/';
	}
}