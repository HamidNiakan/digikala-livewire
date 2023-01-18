<?php

namespace App\Traits;
trait SweatAlert {
	
	public function toastMessage(array $items) {
		$this->emit('toast',[
			'icon' => $items['icon'],
			'title' => $items['title']
		]);
	}
}