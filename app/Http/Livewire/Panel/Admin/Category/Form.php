<?php

namespace App\Http\Livewire\Panel\Admin\Category;

use App\Http\Requests\category\AddCategoryRequest;
use App\Models\Category;
use App\Traits\SweatAlert;
use Livewire\Component;
use Livewire\WithFileUploads;

class Form extends Component {
	use WithFileUploads;
	use SweatAlert;
	
	public Category $category;
	public          $icon;
	
	public function mount () {
		$this->category = new Category();
	}
	
	protected function rules () {
		return ( new AddCategoryRequest() )->rules();
	}
	
	protected function messages () {
		return ( new AddCategoryRequest() )->messages();
	}
	
	public function submit () {
		$this->validate();
		$this->category->save();
		$this->emitUp('refreshTable');
		$this->toastMessage([
								'icon' => __('alert-icon.success') ,
								'title' => __('messages.category.creation') ,
							]);
		$this->category->addMedia($this->icon)
					   ->usingName($this->category->slug)
					   ->toMediaCollection('category-icon');
		$this->category = new Category();
		$this->icon = null;
	}
	
	public function clearForm () {
	
	}
	
	public function render () {
		return view('livewire.panel.admin.category.form');
	}
}
