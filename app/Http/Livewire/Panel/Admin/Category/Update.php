<?php

namespace App\Http\Livewire\Panel\Admin\Category;

use App\Http\Requests\category\UpdateCategoryRequest;
use App\Models\Category;
use App\Traits\SweatAlert;
use Livewire\Component;
use Livewire\WithFileUploads;

class Update extends Component {
	use WithFileUploads;
	use SweatAlert;
	
	public Category $category;
	public          $icon;
	
	public function mount ( string $slug ) {
		$this->category = Category::query()
								  ->where('slug' , $slug)
								  ->first();
	}
	
	protected function rules () {
		return ( new UpdateCategoryRequest() )->rules($this->category->id);
	}
	
	protected function messages () {
		return ( new UpdateCategoryRequest() )->messages();
	}
	
	public function update () {
		$data = $this->validate();
		$this->category->update($data);
		$this->toastMessage([
								'icon' => __('alert-icon.success') ,
								'title' => __('messages.category.creation') ,
							]);
		if ( $this->icon ) {
			$this->category->addMedia($this->icon)
						   ->usingName($this->category->slug)
						   ->toMediaCollection('category-icon');
		}
		$this->popupDialog([
							   'title' => __('alert-icon.title.success') ,
							   'text' => __('messages.category.update') ,
							   'icon' => __('alert-icon.icon.success') ,
							   'route' => route('admin.category.index'),
						   ]);
	}
	
	public function render () {
		$category = $this->category;
		
		return view('livewire.panel.admin.category.update' , compact('category'));
	}
}
