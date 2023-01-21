<?php

namespace App\Http\Livewire\Panel\Admin\ChildCategory;

use App\Http\Requests\childCategory\UpdateChildCategoryRequest;
use App\Models\ChildCategory;
use App\Models\SubCategory;
use App\Traits\SweatAlert;
use Livewire\Component;
use Livewire\WithFileUploads;

class Update extends Component {
	use WithFileUploads;
	use SweatAlert;
	
	public ChildCategory $childCategory;
	public               $icon;
	public               $sub_category_id;
	
	public function mount ( string $slug ) {
		$this->childCategory = ChildCategory::query()
											->where('slug' , $slug)
											->first();
		$this->sub_category_id = $this->childCategory->sub_category_id;
	}
	
	protected function rules () {
		return ( new UpdateChildCategoryRequest() )->rules($this->childCategory->id);
	}
	
	protected function messages () {
		return ( new UpdateChildCategoryRequest() )->messages();
	}
	
	public function update () {
		$this->validate();
		$this->childCategory->sub_category_id = $this->sub_category_id;
		$this->childCategory->save();
		$this->emitUp('refreshTable');
		$this->toastMessage([
								'icon' => __('alert-icon.success') ,
								'title' => __('messages.childCategory.creation') ,
							]);
		if ( $this->icon ) {
			$this->childCategory->addMedia($this->icon)
								->usingName($this->childCategory->slug)
								->toMediaCollection('childCategory-icon');
		}
		$this->popupDialog([
							   'title' => __('alert-icon.title.success') ,
							   'text' => __('messages.childCategory.update') ,
							   'icon' => __('alert-icon.icon.success') ,
							   'route' => route('admin.childCategory.index') ,
						   ]);
	}
	
	public function render () {
		$childCategory = $this->childCategory;
		$subCategories = SubCategory::query()
									 ->get();
		
		return view('livewire.panel.admin.child-category.update' , compact('childCategory','subCategories'));
	}
}
