<?php

namespace App\Http\Livewire\Panel\Admin\Brand;

use App\Models\Brand;
use App\Traits\SweatAlert;
use Livewire\Component;

class DataTable extends Component {
	use SweatAlert;
	
	public Brand $brand;
	
	public function changePublish () {
		if ( $this->brand->is_published ) {
			$this->brand->is_published = false;
			$this->brand->touch();
			$this->toastMessage([
									'icon' => __('alert-icon.icon.success') ,
									'title' => __('messages.brand.unpublished') ,
								]);
			activity()
				->performedOn($this->brand)
				->withProperties($this->brand)
				->log(__('messages.brand.logs.unpublished'));
		}
		else {
			$this->brand->is_published = true;
			$this->brand->touch();
			$this->toastMessage([
									'icon' => __('alert-icon.icon.success') ,
									'title' => __('messages.brand.published') ,
								]);
			activity()
				->performedOn($this->brand)
				->withProperties($this->brand)
				->log(__('messages.brand.logs.published'));
		}
	}
	
	public function destroy () {
		$this->brand->delete();
		$this->toastMessage([
								'icon' => __('alert-icon.icon.success') ,
								'title' => __('messages.brand.destroy') ,
							]);
		activity()
			->performedOn($this->brand)
			->withProperties($this->brand)
			->log(__('messages.brand.logs.delete'));
		$this->emitUp('refreshTable');
		$this->emit('trashCount' , [
			'count' => Brand::trashCount() ,
		]);
	}
	
	public function edit () {
		return redirect()->route('admin.brand.update' , $this->brand->slug);
	}
	
	public function render () {
		return view('livewire.panel.admin.brand.data-table');
	}
}
