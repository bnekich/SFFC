<?php

namespace App\View\Components;

use Illuminate\View\Component;

class DashboardItemOpenCases extends Component
{
    public $openCasesCount;

    public function __construct()
    {
        $this->openCasesCount = \App\Models\CaseModel::where('case_status_id', '=', '1')->count();
    }

    public function render()
    {
        return view('components.dashboard-item-open-cases');
    }
}
