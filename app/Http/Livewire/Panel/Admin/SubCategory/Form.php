<?php

namespace App\Http\Livewire\Panel\Admin\SubCategory;

use App\Http\Requests\subCategory\AddSubCategoryRequest;
use App\Models\Category;
use App\Models\SubCategory;
use App\Traits\SweatAlert;
use Livewire\Component;
use Livewire\WithFileUploads;

class Form extends Component
{
	use WithFileUploads;
	use SweatAlert;
	
	public SubCategory $subCategory;
	public          $icon;
	
	public function mount () {
		$this->subCategory = new SubCategory();
	}
	
	protected function rules () {
		return ( new AddSubCategoryRequest() )->rules();
	}
	
	protected function messages () {
		return ( new AddSubCategoryRequest() )->messages();
	}
	
	public function submit () {
		$this->validate();
		$this->subCategory->save();
		$this->emitUp('refreshTable');
		$this->toastMessage([
								'icon' => __('alert-icon.success') ,
								'title' => __('messages.subCategory.creation') ,
							]);
		$this->subCategory->addMedia($this->icon)
					   ->usingName($this->subCategory->slug)
					   ->toMediaCollection('subCategory-icon');
		$this->subCategory = new SubCategory();
		$this->icon = null;
		activity()
			->performedOn($this->subCategory)
			->withProperties($this->subCategory)
			->log(__('messages.subCategory.logs.create'));
	}
    public function render()
    {
		$categories = Category::query()->get();
        return view('livewire.panel.admin.sub-category.form',compact('categories'));
    }
}
