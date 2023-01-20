<?php

namespace App\Http\Livewire\Panel\Admin\SubCategory;

use App\Http\Requests\subCategory\AddSubCategoryRequest;
use App\Http\Requests\subCategory\UpdateSubcategoryRequest;
use App\Models\Category;
use App\Models\SubCategory;
use App\Traits\SweatAlert;
use Livewire\Component;
use Livewire\WithFileUploads;

class Update extends Component {
	use WithFileUploads;
	use SweatAlert;
	
	public SubCategory  $subCategory;
	public             $icon;
	public             $category_id;
	
	public function mount ( string $slug ) {
		$this->subCategory = SubCategory::query()
										->where('slug' , $slug)
										->first();
		$this->category_id = $this->subCategory->category_id;
	}
	
	protected function rules () {
		return ( new UpdateSubcategoryRequest() )->rules($this->subCategory->id);
	}
	
	protected function messages () {
		return ( new AddSubCategoryRequest() )->messages();
	}
	
	public function update () {
		$this->validate();
		$this->subCategory->category_id = $this->category_id;
		$this->subCategory->save();
		$this->emitUp('refreshTable');
		$this->toastMessage([
								'icon' => __('alert-icon.success') ,
								'title' => __('messages.subCategory.creation') ,
							]);
		if ( $this->icon ) {
			$this->subCategory->addMedia($this->icon)
							  ->usingName($this->subCategory->slug)
							  ->toMediaCollection('subCategory-icon');
		}
		$this->popupDialog([
							   'title' => __('alert-icon.title.success') ,
							   'text' => __('messages.subCategory.update') ,
							   'icon' => __('alert-icon.icon.success') ,
							   'route' => route('admin.subCategory.index') ,
						   ]);
	}
	
	public function render () {
		$subCategory = $this->subCategory;
		$categories = Category::query()
							  ->get();
		
		return view('livewire.panel.admin.sub-category.update' , compact('subCategory' , 'categories'));
	}
}
