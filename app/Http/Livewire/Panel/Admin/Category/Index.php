<?php

namespace App\Http\Livewire\Panel\Admin\Category;

use App\Models\Category;
use Livewire\Component;

class Index extends Component {
	
	protected $listeners = [ 'refreshTable' => '$refresh' ];
	
	public function render () {
		$categories = Category::query()
							  ->get();
		
		return view('livewire.panel.admin.category.index' , compact('categories'));
	}
}
