<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class DashboardItemVolunteers extends Component
{
    public $newVolunteersCount;

    public function __construct()
    {
        $this->newVolunteersCount = \App\Models\Volunteer::where('volunteer_status_id', '=', '1')->count();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.dashboard-item-volunteers');
    }
}
