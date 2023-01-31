<?php

namespace App\Http\Livewire\Panel\Admin\ChildCategory;

use App\Models\Category;
use App\Models\ChildCategory;
use App\Models\SubCategory;
use App\Traits\SweatAlert;
use Livewire\Component;

class DataTable extends Component
{
	public ChildCategory $childCategory;
	
	use SweatAlert;
	
	public function changePublish () {
		if ( $this->childCategory->is_published ) {
			$this->childCategory->is_published = false;
			$this->childCategory->touch();
			$this->toastMessage([
									'icon' => __('alert-icon.icon.success') ,
									'title' => __('messages.childCategory.unpublished'),
								]);
			activity()
				->performedOn($this->childCategory)
				->withProperties($this->childCategory)
				->log(__('messages.childCategory.logs.unpublished'));
		}
		else {
			$this->childCategory->is_published = true;
			$this->childCategory->touch();
			$this->toastMessage([
									'icon' => __('alert-icon.icon.success') ,
									'title' => __('messages.childCategory.published'),
								]);
			activity()
				->performedOn($this->childCategory)
				->withProperties($this->childCategory)
				->log(__('messages.childCategory.logs.published'));
		}
	}
	
	public function destroy () {
		$this->emit('destroy' , $this->childCategory->id);
		$this->childCategory->delete();
		$this->toastMessage([
								'icon' => __('alert-icon.icon.success') ,
								'title' => __('messages.childCategory.destroy'),
							]);
		$this->emit('childCategoryTrashCount',[
			'count' => ChildCategory::query()->onlyTrashed()->count()
		]);
		activity()
			->performedOn($this->childCategory)
			->withProperties($this->childCategory)
			->log(__('messages.childCategory.logs.delete'));
	}
	
	public function edit() {
		return redirect()->route('admin.childCategory.update',['slug' => $this->childCategory->slug]);
	}
    public function render()
    {
        return view('livewire.panel.admin.child-category.data-table');
    }
}
