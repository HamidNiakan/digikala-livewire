<?php

namespace App\Http\Livewire\Panel\Admin\Brand;

use App\Http\Livewire\Panel\Admin\Dashboard\Breadcrumb;
use App\Models\Brand;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component {
	use WithPagination;
	
	public     $readToLoad  = false;
	public int $trashCount  = 0;
	public     $search;
	protected  $listeners   = [
		'refreshTable' => '$refresh' ,
		'trashCount' => 'trashCount' ,
	];
	protected  $queryString = [
		'search' ,
	];
	
	public function loadBrands () {
		$this->readToLoad = true;
	}
	
	public function mount () {
		$this->trashCount = Brand::trashCount();
	}
	
	protected $paginationTheme = 'bootstrap';
	
	public function trashCount ( $params ) {
		$this->trashCount = $params[ 'count' ];
	}
	
	public function render () {
		$brands = $this->readToLoad ? Brand::query()
										   ->where(function ( $qry ) {
											   $qry->where('title' , "LIKE" , "%{$this->search}%");
										   })
										   ->latest()
										   ->paginate(4) : [];
		
		return view('livewire.panel.admin.brand.index' , compact('brands'));
	}
}
