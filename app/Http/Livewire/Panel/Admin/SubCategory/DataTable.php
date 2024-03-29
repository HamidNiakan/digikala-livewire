<?php

namespace App\Http\Livewire\Panel\Admin\SubCategory;

use App\Models\Category;
use App\Models\SubCategory;
use App\Traits\SweatAlert;
use Livewire\Component;

class DataTable extends Component {
	use SweatAlert;
	
	public SubCategory $subCategory;
	
	public function changePublish () {
		if ( $this->subCategory->is_published ) {
			$this->subCategory->is_published = false;
			$this->subCategory->touch();
			$this->toastMessage([
									'icon' => __('alert-icon.icon.success') ,
									'title' => __('messages.subCategory.unpublished') ,
								]);
			activity()
				->performedOn($this->subCategory)
				->withProperties($this->subCategory)
				->log(__('messages.subCategory.logs.unpublished'));
		}
		else {
			$this->subCategory->is_published = true;
			$this->subCategory->touch();
			$this->toastMessage([
									'icon' => __('alert-icon.icon.success') ,
									'title' => __('messages.subCategory.published') ,
								]);
			activity()
				->performedOn($this->subCategory)
				->withProperties($this->subCategory)
				->log(__('messages.subCategory.logs.published'));
		}
	}
	
	public function destroy () {
		$this->emit('destroy' , $this->subCategory->id);
		$this->subCategory->delete();
		$this->toastMessage([
								'icon' => __('alert-icon.icon.success') ,
								'title' => __('messages.subCategory.destroy') ,
							]);
		$this->emit('subCategoryTrashCount' , [
			'count' => Category::query()
							   ->onlyTrashed()
							   ->count() ,
		]);
		activity()
			->performedOn($this->subCategory)
			->withProperties($this->subCategory)
			->log(__('messages.subCategory.logs.delete'));
	}
	
	public function edit () {
		return redirect()->route('admin.subCategory.update' , [ 'slug' => $this->subCategory->slug ]);
	}
	
	public function render () {
		return view('livewire.panel.admin.sub-category.data-table');
	}
}
