<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class DashboardItemReferrals extends Component
{
    public $newReferralsCount;

    public function __construct()
    {
        $this->newReferralsCount = \App\Models\Intake::where('intake_status_id', '=', '1')->count();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.dashboard-item-referrals');
    }
}
