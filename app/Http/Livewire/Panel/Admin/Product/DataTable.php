<?php

namespace App\Http\Livewire\Panel\Admin\Product;

use App\Models\Category;
use App\Models\Product;
use App\Traits\SweatAlert;
use Livewire\Component;

class DataTable extends Component {
	use SweatAlert;
	
	public Product $product;
	
	public function changePublish () {
		if ( $this->product->is_published ) {
			$this->product->is_published = false;
			$this->product->touch();
			$this->toastMessage([
									'icon' => __('alert-icon.icon.success') ,
									'title' => __('messages.product.unpublished') ,
								]);
			activity()
				->performedOn($this->product)
				->withProperties($this->product)
				->log(__('messages.global.logs.unpublished'));
		}
		else {
			$this->product->is_published = true;
			$this->product->touch();
			$this->toastMessage([
									'icon' => __('alert-icon.icon.success') ,
									'title' => __('messages.product.published') ,
								]);
			activity()
				->performedOn($this->product)
				->withProperties($this->product)
				->log(__('messages.global.logs.published'));
		}
	}
	
	public function edit () {
		return redirect()->route('admin.product.update' , $this->product->slug);
	}
	
	public function destroy () {
		$this->product->delete();
		$this->toastMessage([
								'icon' => __('alert-icon.icon.success') ,
								'title' => __('messages.product.destroy') ,
							]);
		$this->emit('categoryTrashCount' , [
			'count' => Category::query()
							   ->onlyTrashed()
							   ->count(),
		]);
		activity()
			->performedOn($this->product)
			->withProperties($this->product)
			->log(__('messages.global.logs.delete'));
	}
	
	public function render () {
		return view('livewire.panel.admin.product.data-table');
	}
}
