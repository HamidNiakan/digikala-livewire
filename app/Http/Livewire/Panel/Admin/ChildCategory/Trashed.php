<?php

namespace App\Http\Livewire\Panel\Admin\ChildCategory;

use App\Models\ChildCategory;
use App\Models\SubCategory;
use App\Traits\SweatAlert;
use Livewire\Component;
use Livewire\WithPagination;

class Trashed extends Component
{
	use WithPagination;
	use SweatAlert;
	
	public    $search;
	protected $queryString = [
		'search',
	];
	public $readToLoad = false;
	
	public function loadCategories () {
		$this->readToLoad = true;
	}
	
	public function recoveryCategory ( int $categoryId ) {
		$childCategory = ChildCategory::query()
								  ->withTrashed()
								  ->find($categoryId);
		if ( $childCategory ) {
			$childCategory->restore();
			$this->toastMessage([
									'icon' => __('alert-icon.icon.success') ,
									'title' => __('messages.subCategory.restore') ,
								]);
		}
	}
	
	public function destroyCategory ( int $categoryId ) {
		$childCategory = ChildCategory::query()
								  ->withTrashed()
								  ->find($categoryId);
		if ( $childCategory ) {
			$childCategory->forceDelete();
			$this->toastMessage([
									'icon' => __('alert-icon.icon.success') ,
									'title' => __('messages.subCategory.destroy') ,
								]);
		}
	}
    public function render()
    {
		$childCategories = ChildCategory::query()
									->onlyTrashed()
									->where(function ( $query ) {
										$query->where('title' , 'LIKE' , "%{$this->search}%")
											  ->orWhere('slug' , 'LIKE' , "%{$this->search}%")
											  ->orWhere('id' , $this->search);
									})
									->paginate(10);
		$trashCount = ChildCategory::query()
								 ->onlyTrashed()
								 ->count();
        return view('livewire..panel.admin.child-category.trashed',[
			'subCategories' => $this->readToLoad ? $childCategories : [] ,
			'trashCount' => $trashCount ,
		]);
    }
}
