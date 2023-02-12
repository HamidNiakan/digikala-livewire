<?php

namespace App\Http\Livewire\Panel\Admin\Product;

use App\Models\Product;
use App\Traits\SweatAlert;
use Livewire\Component;
use Livewire\WithPagination;

class Trashed extends Component {
	use WithPagination;
	use SweatAlert;
	
	public      $search;
	public bool $readToLoad      = false;
	protected   $paginationTheme = 'bootstrap';
	public int  $trashCount      = 0;
	protected   $queryString     = [
		'search' ,
	];
	
	public function loadProducts () {
		$this->readToLoad = true;
	}
	
	public function recovery ( int $productId ) {
		$product = Product::query()
						  ->onlyTrashed()
						  ->find($productId);
		if ( $product ) {
			$product->restore();
			$this->toastMessage([
									'icon' => __('alert-icon.icon.success') ,
									'title' => __('messages.product.restore') ,
								]);
			activity()
				->performedOn($product)
				->withProperties($product)
				->log(__('messages.global.logs.recovery'));
		}
	}
	
	public function destroy ( int $productId ) {
		$product = Product::query()
						  ->onlyTrashed()
						  ->find($productId);
		if ( $product ) {
			$product->forceDelete();
			$this->toastMessage([
									'icon' => __('alert-icon.icon.success') ,
									'title' => __('messages.product.destroy') ,
								]);
			activity()
				->performedOn($product)
				->withProperties($product)
				->log(__('messages.global.logs.force-delete'));
		}
	}
	
	public function render () {
		$this->trashCount = Product::query()
								   ->onlyTrashed()
								   ->count();
		$products = $this->readToLoad ? Product::query()
											   ->with([
														  'brand' ,
														  'category' ,
														  'subCategory' ,
														  'childCategory' ,
													  ])
											   ->onlyTrashed()
											   ->latest()
											   ->paginate(5) : [];
		
		return view('livewire.panel.admin.product.trashed' , compact('products'));
	}
}
