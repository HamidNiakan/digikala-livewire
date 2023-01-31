<?php

namespace App\Http\Livewire\Panel\Admin\Log;

use Livewire\Component;
use Spatie\Activitylog\Models\Activity;

class DataTable extends Component
{
	public Activity $activity;
    public function render()
    {
        return view('livewire.panel.admin.log.data-table');
    }
}
