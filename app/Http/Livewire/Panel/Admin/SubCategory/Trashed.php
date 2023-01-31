<?php

namespace App\Http\Livewire\Panel\Admin\SubCategory;

use App\Models\SubCategory;
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
		$subCategory = SubCategory::query()
								  ->withTrashed()
								  ->find($categoryId);
		if ( $subCategory ) {
			$subCategory->restore();
			$this->toastMessage([
									'icon' => __('alert-icon.icon.success') ,
									'title' => __('messages.subCategory.restore') ,
								]);
			activity()
				->performedOn($subCategory)
				->withProperties($subCategory)
				->log(__('messages.subCategory.logs.recovery'));
		}
	}
	
	public function destroyCategory ( int $categoryId ) {
		$subCategory = SubCategory::query()
								  ->withTrashed()
								  ->find($categoryId);
		if ( $subCategory ) {
			$subCategory->forceDelete();
			$this->toastMessage([
									'icon' => __('alert-icon.icon.success') ,
									'title' => __('messages.subCategory.destroy') ,
								]);
			activity()
				->performedOn($subCategory)
				->withProperties($subCategory)
				->log(__('messages.subCategory.logs.force-delete'));
		}
	}
	
	public function render () {
		$subCategories = SubCategory::query()
									->onlyTrashed()
									->where(function ( $query ) {
										$query->where('title' , 'LIKE' , "%{$this->search}%")
											  ->orWhere('slug' , 'LIKE' , "%{$this->search}%")
											  ->orWhere('id' , $this->search);
									})
									->paginate(10);
		$trashCount = SubCategory::query()
								 ->onlyTrashed()
								 ->count();
		
		return view('livewire..panel.admin.sub-category.trashed' , [
			'subCategories' => $this->readToLoad ? $subCategories : [] ,
			'trashCount' => $trashCount ,
		]);
	}
}
