<?php

namespace App\View\Components;

use Illuminate\View\Component;

class DashboardItemPendingAppointments extends Component
{
    public $pendingAppointmentsCount;

    public function __construct()
    {
        $this->pendingAppointmentsCount = \App\Models\Appointment::where('start', '<', today())->count();
    }

    public function render()
    {
        return view('components.dashboard-item-pending-appointments');
    }
}
