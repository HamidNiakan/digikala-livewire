<?php

namespace App\Http\Livewire\Panel\Admin\ChildCategory;

use App\Http\Requests\childCategory\AddChildCategoryRequest;
use App\Models\ChildCategory;
use App\Models\SubCategory;
use App\Traits\SweatAlert;
use Livewire\Component;
use Livewire\WithFileUploads;

class Form extends Component {
	use WithFileUploads;
	use SweatAlert;
	
	public ChildCategory $childCategory;
	public               $icon;
	
	public function mount () {
		$this->childCategory = new ChildCategory();
	}
	
	protected function rules () {
		return ( new AddChildCategoryRequest() )->rules();
	}
	
	protected function messages () {
		return ( new AddChildCategoryRequest() )->messages();
	}
	
	public function submit () {
		$this->validate();
		$this->childCategory->save();
		$this->emitUp('refreshTable');
		$this->toastMessage([
								'icon' => __('alert-icon.success') ,
								'title' => __('messages.childCategory.creation') ,
							]);
		$this->childCategory->addMedia($this->icon)
							->usingName($this->childCategory->slug)
							->toMediaCollection('childCategory-icon');
		$this->childCategory = new ChildCategory();
		$this->icon = null;
	}
	
	public function render () {
		$subcategories = SubCategory::query()
									->get();
		
		return view('livewire.panel.admin.child-category.form' , compact('subcategories'));
	}
}
