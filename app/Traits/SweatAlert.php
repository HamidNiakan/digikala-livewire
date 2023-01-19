<?php

namespace App\Traits;
trait SweatAlert {
	
	public function toastMessage(array $items) {
		$this->emit('toast',[
			'icon' => $items['icon'],
			'title' => $items['title']
		]);
	}
	
	public function popupDialog(array $items) {
		$this->emit('popup-dialog',[
			'title' => $items['title'] ?? null,
			'text' => $items['text'] ?? null,
			'icon' => $items['icon'] ?? null,
			'route' => $items['route'] ?? null,
		]);
	}
}