<?php

namespace App\Http\Livewire\Panel\Admin\ChildCategory;

use App\Models\ChildCategory;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component {
	use WithPagination;
	
	public $readToLoad     = false;
	public int $trashCount = 0;
	
	public function loadChildCategories () {
		$this->readToLoad = true;
	}
	
	protected $paginationTheme = 'bootstrap';
	protected $listeners       = [
		'refreshTable' => '$refresh' ,
		'childCategoryTrashCount',
	];
	public    $search;
	protected $queryString     = [
		'search' ,
	];
	
	public function childCategoryTrashCount ( array $params ) {
		$this->trashCount = $params[ 'count' ];
	}
	
	public function render () {
		$childCategories = ChildCategory::query()
										->where(function ( $query ) {
											$query->where('title' , 'LIKE' , "%{$this->search}%")
												  ->orWhere('slug' , 'LIKE' , "%{$this->search}%")
												  ->orWhere('id' , $this->search);
										})
										->latest()
										->paginate(4);
		$this->trashCount = ChildCategory::query()
										 ->onlyTrashed()
										 ->count();
		
		return view('livewire.panel.admin.child-category.index' , compact('childCategories'));
	}
}
