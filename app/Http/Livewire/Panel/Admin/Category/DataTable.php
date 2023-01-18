<?php

namespace App\Http\Livewire\Panel\Admin\Category;

use App\Models\Category;
use App\Traits\SweatAlert;
use Livewire\Component;

class DataTable extends Component {
	use SweatAlert;
	
	public Category $category;
	
	public function changePublish () {
		if ( $this->category->is_published ) {
			$this->category->is_published = false;
			$this->category->touch();
			$this->toastMessage([
									'icon' => __('alert-icon.success') ,
									'title' => __('messages.category.unpublished'),
								]);
		}
		else {
			$this->category->is_published = true;
			$this->category->touch();
			$this->toastMessage([
									'icon' => __('alert-icon.success') ,
									'title' => __('messages.category.published'),
								]);
		}
	}
	
	public function destroy () {
		$this->emit('destroy' , $this->category->id);
		$this->category->delete();
		$this->toastMessage([
								'icon' => __('alert-icon.success') ,
								'title' => __('messages.category.destroy'),
							]);
	}
	
	public function render () {
		return view('livewire.panel.admin.category.data-table');
	}
}
