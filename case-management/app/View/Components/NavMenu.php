<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Auth;

class NavMenu extends Component
{
    public $links;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        $userName = Auth::user()->firstName . ' ' . Auth::user()->lastName;
        $this->links = [
            ['name' => 'Cases', 'url' => route('case.index')],
            ['name' => 'Intake', 'url' => route('intake.index')],
            ['name' => 'Families', 'url' => route('family.index')],
            ['name' => 'People', 'url' => route('person.index')],
            ['name' => 'Organizations', 'url' => route('organization.index')],
            ['name' => 'Documents', 'url' => route('document.index')],
            ['name' => 'Notes', 'url' => route('note.index')],
            ['name' => 'Admin', 'url' => '#', 'submenu' => [
                ['name' => 'Users', 'url' => route('users.index')],
                ['name' => 'Roles', 'url' => route('roles.index')],
                ['name' => 'Permissions', 'url' => route('permissions.index')],
                ['name' => 'Audit Logs', 'url' => route('audit-logs.index')],
                ['name' => 'Organization Types', 'url' => route('organization-types.index')],
                ['name' => 'Tags', 'url' => route('tag.index')],
                ['name' => 'Case Statuses', 'url' => route('case-statuses.index')],
                ['name' => 'Volunteer Statuses', 'url' => route('volunteer-statuses.index')],
            ]],
            ['name' => $userName, 'url' => '#', 'submenu' => [
                ['name' => 'Logout', 'action' => 'logout']
            ]]
        ];
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.nav-menu');
    }
}
