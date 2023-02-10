<?php

namespace App\Http\Livewire\Panel\Admin\Product;

use App\Enums\ProductStatus;
use App\Models\Product;
use App\Traits\SweatAlert;
use Livewire\Component;

class DataTable extends Component {
	use SweatAlert;
	
	public Product $product;
	
	public function changeStatus () {
		if ( $this->product->status === ProductStatus::DeActive ) {
			$this->product->status = ProductStatus::Active;
			$this->product->touch();
			$this->toastMessage([
									'icon' => __('alert-icon.icon.success') ,
									'title' => __('messages.product.active') ,
								]);
			activity()
				->performedOn($this->product)
				->withProperties($this->product)
				->log(__('messages.product.log.active'));
		}
		else {
			$this->product->status = ProductStatus::DeActive;
			$this->product->touch();
			$this->toastMessage([
									'icon' => __('alert-icon.icon.success') ,
									'title' => __('messages.product.deActive') ,
								]);
			activity()
				->performedOn($this->product)
				->withProperties($this->product)
				->log(__('messages.product.log.deActive'));
		}
	}
	
	public function render () {
		return view('livewire.panel.admin.product.data-table');
	}
}
