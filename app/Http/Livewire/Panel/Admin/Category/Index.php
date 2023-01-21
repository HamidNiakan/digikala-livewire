<?php

namespace App\Http\Livewire\Panel\Admin\Category;

use App\Models\Category;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component {
	use WithPagination;
	
	public $readToLoad = false;
	
	public function loadCategories () {
		$this->readToLoad = true;
	}
	
	
	protected $paginationTheme = 'bootstrap';
	protected $listeners       = [ 'refreshTable' => '$refresh', 'categoryTrashCount' => 'categoryTrashCount' ];
	public    $search;
	public int $trashCount = 0;
	protected $queryString = [
		'search',
	];
	
	public function categoryTrashCount(array $params) {
		$this->trashCount = $params['count'];
	}
	
	public function render () {
		$categories = Category::query()
							  ->where(function ( $query ) {
								  $query->where('title' , 'LIKE' , "%{$this->search}%")
										->orWhere('slug' , 'LIKE' , "%{$this->search}%")
										->orWhere('id' , $this->search);
							  })
							  ->latest()
							  ->paginate(4);
		$this->trashCount = Category::query()->onlyTrashed()->count();
		return view('livewire.panel.admin.category.index' , [
			'categories' => $this->readToLoad ? $categories : [],
		]);
	}
}
