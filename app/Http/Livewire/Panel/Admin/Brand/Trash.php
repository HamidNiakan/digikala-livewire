<?php

namespace App\Http\Livewire\Panel\Admin\Brand;

use App\Models\Brand;
use App\Traits\SweatAlert;
use Livewire\Component;
use Livewire\WithPagination;

class Trash extends Component {
	use WithPagination;
	use SweatAlert;
	
	public    $search;
	protected $queryString     = [
		'search' ,
	];
	protected $paginationTheme = "bootstrap";
	public    $readToLoad      = false;
	
	public function loadBrands () {
		$this->readToLoad = true;
	}
	
	public $trashCount;
	
	public function mount () {
		$this->trashCount = Brand::trashCount();
	}
	
	public function recovery ( $brandId ) {
		$brand = Brand::query()
					  ->onlyTrashed()
					  ->find($brandId);
		if ( $brand ) {
			$brand->restore();
			$this->trashCount = Brand::trashCount();
			$this->toastMessage([
									'icon' => __('alert-icon.icon.success') ,
									'title' => __('messages.brand.restore') ,
								]);
			activity()
				->performedOn($brand)
				->withProperties($brand)
				->log(__('messages.brand.logs.recovery'));
		}
	}
	
	public function destroy ( $brandId ) {
		$brand = Brand::query()
					  ->onlyTrashed()
					  ->find($brandId);
		if ( $brand ) {
			$brand->forceDelete();
			$this->trashCount = Brand::trashCount();
			$this->toastMessage([
									'icon' => __('alert-icon.icon.success') ,
									'title' => __('messages.brand.destroy') ,
								]);
			activity()
				->performedOn($brand)
				->withProperties($brand)
				->log(__('messages.brand.logs.force-delete'));
		}
	}
	
	public function render () {
		$brands = $this->readToLoad ? Brand::query()
										   ->onlyTrashed()
										   ->where(function ( $qry ) {
											   $qry->where('title' , "LIKE" , "%{$this->search}%");
										   })
										   ->latest()
										   ->paginate(5) : [];
		
		return view('livewire.panel.admin.brand.trash' , compact('brands'));
	}
}
