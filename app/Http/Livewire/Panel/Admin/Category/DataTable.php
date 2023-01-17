<?php

namespace App\Http\Livewire\Panel\Admin\Category;

use App\Models\Category;
use Livewire\Component;

class DataTable extends Component {
	public Category $category;
	
	public function changePublish () {
		if ( $this->category->is_published ) {
			$this->category->is_published = false;
			$this->category->touch();
			$this->emit('toast',[
				'icon' => __('alert-icon.success'),
				'title' => __('messages.category.unpublished')
			]);
		}
		else {
			$this->category->is_published = true;
			$this->category->touch();
			$this->emit('toast',[
				'icon' => __('alert-icon.success'),
				'title' => __('messages.category.published')
			]);
		}
	}
	
	
	public function destroy() {
		$this->emit('destroy', $this->category->id);
		$this->category->delete();
		$this->emit('toast',[
			'icon' => __('alert-icon.success'),
			'title' => __('messages.category.destroy')
		]);
	}
	public function render () {
		return view('livewire.panel.admin.category.data-table');
	}
}
