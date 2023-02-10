<?php

namespace App\Http\Livewire\Panel\Admin\Product;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component {
	use WithPagination;
	
	protected   $paginationTheme = 'bootstrap';
	public int  $trashCount      = 0;
	public      $search;
	public bool $readToLoad      = false;
	
	public function loadProducts () {
		$this->readToLoad = true;
	}
	
	protected $queryString = [
		'search' ,
	];
	
	public function render () {
		$products = $this->readToLoad ? Product::query()
											   ->with([
														  'category' ,
														  'subCategory' ,
														  'childCategory' ,
													  ])
											   ->where(function ( $qry ) {
												   $qry->where('code' , $this->search)
													   ->orWhere('title' , 'LIKE' , "%{$this->search}%")
													   ->orWhere('title_en' , 'LIKE' , "%{$this->search}%");
											   })
											   ->latest()
											   ->paginate(6) : [];
		
		return view('livewire.panel.admin.product.index' , compact('products'));
	}
}
