<?php

namespace App\Http\Livewire\Panel\Admin\Brand;

use App\Http\Requests\brand\UpdateBrandRequest;
use App\Models\Brand;
use App\Models\Category;
use App\Traits\SweatAlert;
use Livewire\Component;
use Livewire\WithFileUploads;

class Update extends Component {
	use WithFileUploads;
	use SweatAlert;
	
	public Brand $brand;
	public       $icon;
	
	public function mount ( string $slug ) {
		$this->brand = Brand::query()
							->where('slug' , $slug)
							->firstOrFail();
	}
	
	protected function rules () {
		if ( $this->brand->id ) {
			return ( new UpdateBrandRequest() )->rules($this->brand->id);
		}
	}
	
	protected function messages () {
		if ( $this->brand->id ) {
			return ( new UpdateBrandRequest() )->messages();
		}
	}
	
	public function update () {
		$data = $this->validate();
		$this->brand->fill($data);
		$this->brand->save();
		if ( $this->icon ) {
			$this->brand->addMedia($this->icon)
						->usingName($this->brand->slug)
						->toMediaCollection(__('messages.brand.media-collection'));
		}
		$this->popupDialog([
							   'title' => __('alert-icon.title.success') ,
							   'text' => __('messages.brand.update') ,
							   'icon' => __('alert-icon.icon.success') ,
							   'route' => route('admin.brand.index') ,
						   ]);
		$this->icon = null;
		activity()
			->performedOn($this->brand)
			->withProperties($this->brand)
			->log(__('messages.brand.logs.update'));
	}
	
	public function render () {
		$categories = Category::query()
							  ->where('is_published' , true)
							  ->get();
		return view('livewire.panel.admin.brand.update',compact('categories'));
	}
}
