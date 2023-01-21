<?php

namespace App\Http\Livewire\Panel\Admin\ChildCategory;

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
		}
		else {
			$this->childCategory->is_published = true;
			$this->childCategory->touch();
			$this->toastMessage([
									'icon' => __('alert-icon.icon.success') ,
									'title' => __('messages.childCategory.published'),
								]);
		}
	}
	
	public function destroy () {
		$this->emit('destroy' , $this->childCategory->id);
		$this->childCategory->delete();
		$this->toastMessage([
								'icon' => __('alert-icon.icon.success') ,
								'title' => __('messages.childCategory.destroy'),
							]);
	}
	
	public function edit() {
		return redirect()->route('admin.childCategory.update',['slug' => $this->childCategory->slug]);
	}
    public function render()
    {
        return view('livewire.panel.admin.child-category.data-table');
    }
}
