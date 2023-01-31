<?php

namespace App\Http\Livewire\Panel\Admin\Category;

use App\Models\Category;
use App\Traits\SweatAlert;
use Livewire\Component;
use Livewire\WithPagination;

class Trashed extends Component {
	use WithPagination;
	use SweatAlert;
	
	public    $search;
	protected $queryString = [
		'search' ,
	];
	public    $readToLoad  = false;
	
	public function loadCategories () {
		$this->readToLoad = true;
	}
	
	public function recoveryCategory ( int $categoryId ) {
		$category = Category::query()
							->withTrashed()
							->find($categoryId);
		if ( $category ) {
			$category->restore();
			$this->toastMessage([
									'icon' => __('alert-icon.icon.success') ,
									'title' => __('messages.category.restore') ,
								]);
			activity()
				->performedOn($category)
				->withProperties($category)
				->log(__('messages.category.logs.recovery'));
		}
	}
	
	public function destroyCategory ( int $categoryId ) {
		$category = Category::query()
							->withTrashed()
							->find($categoryId);
		if ( $category ) {
			$category->forceDelete();
			$this->toastMessage([
									'icon' => __('alert-icon.icon.success') ,
									'title' => __('messages.category.destroy') ,
								]);
			activity()
				->performedOn($category)
				->withProperties($category)
				->log(__('messages.category.logs.force-delete'));
		}
	}
	
	public function render () {
		$categories = Category::query()
							  ->onlyTrashed()
							  ->where(function ( $query ) {
								  $query->where('title' , 'LIKE' , "%{$this->search}%")
										->orWhere('slug' , 'LIKE' , "%{$this->search}%")
										->orWhere('id' , $this->search);
							  })
							  ->paginate(10);
		$trashCount = Category::query()
							  ->onlyTrashed()
							  ->count();
		
		return view('livewire..panel.admin.category.trashed' , [
			'categories' => $this->readToLoad ? $categories : [] ,
			'trashCount' => $trashCount ,
		]);
	}
}
