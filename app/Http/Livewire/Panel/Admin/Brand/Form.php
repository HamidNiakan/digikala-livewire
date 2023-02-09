<?php

namespace App\Http\Livewire\Panel\Admin\Brand;

use App\Http\Requests\brand\AddBrandRequest;
use App\Models\Brand;
use App\Traits\SweatAlert;
use Livewire\Component;
use Livewire\WithFileUploads;

class Form extends Component {
	use SweatAlert;
	use WithFileUploads;
	
	public Brand $brand;
	public       $icon;
	
	protected function rules () {
		return ( new AddBrandRequest() )->rules();
	}
	
	protected function messages () {
		return ( new AddBrandRequest() )->messages();
	}
	
	public function mount () {
		$this->brand = new Brand();
	}
	
	public function submit () {
		$data = $this->validate();
		$this->brand->fill($data);
		$this->brand->save();
		$this->brand->addMedia($this->icon)
					->usingName($this->brand->title)
					->toMediaCollection(__('messages.brand.media-collection'));
		$this->toastMessage([
								'icon' => __('alert-icon.icon.success') ,
								'title' => __('messages.brand.creation') ,
							]);
		$this->emitUp('refreshTable');
		activity()
			->performedOn($this->brand)
			->withProperties($this->brand)
			->log(__('messages.brand.logs.create'));
		$this->brand = new Brand();
		$this->icon = null;
	}
	
	public function render () {
		return view('livewire.panel.admin.brand.form');
	}
}
