<?php

namespace App\Enums;
enum ProductQuality: string {
	case Copy = 'copy';
	case HighCopy = 'highCopy';
	case Genuine = 'genuine';
	case Original = 'original';
}