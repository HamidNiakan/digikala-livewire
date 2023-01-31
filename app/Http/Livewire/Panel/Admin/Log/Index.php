<?php

namespace App\Http\Livewire\Panel\Admin\Log;

use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Activitylog\Models\Activity;

class Index extends Component {
	use WithPagination;
	
	protected $paginationTheme = 'bootstrap';
	public    $search;
	public    $readToLoad      = false;
	
	public function loadActivites () {
		$this->readToLoad = true;
	}
	
	public function render () {
		$activities = Activity::query()
							  ->where(function ( $qry ) {
								  $qry->where('log_name' , 'LIKE' , "%{$this->search}%")
									  ->orWhere('description' , 'LIKE' , "%{$this->search}%");
							  })
							  ->paginate(15);
		
		return view('livewire.panel.admin.log.index' , compact('activities'));
	}
}
