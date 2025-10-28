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
            ['name' => 'Cases', 'url' => route('case.index', ['direction' => 'asc', 'sort' => 'case_identifier']), 'permission' => 'case-view'],
            ['name' => 'Intake', 'url' => route('intake.index', ['direction' => 'asc', 'sort' => 'parent_name']), 'permission' => 'intake-view'],
            ['name' => 'Families', 'url' => route('family.index'), 'permission' => 'family-view'],
            ['name' => 'People', 'url' => '#', 'submenu' => [
                ['name' => 'People', 'url' => route('person.index', ['direction' => 'asc', 'sort' => 'last_name']), 'permission' => 'person-view'],
                ['name' => 'Volunteers', 'url' => route('volunteer.index'), 'permission' => 'volunteer-view']
            ], 'permission' => 'person-view'],
            ['name' => 'Organizations', 'url' => route('organization.index'), 'permission' => 'organization-view'],
            ['name' => 'Documents', 'url' => route('document.index'), 'permission' => 'document-view'],
            ['name' => 'Notes', 'url' => route('note.index'), 'permission' => 'note-view'],
            ['name' => 'Admin', 'url' => '#', 'submenu' => [
                ['name' => 'Users', 'url' => route('users.index'), 'permission' => 'user-view'],
                ['name' => 'Roles', 'url' => route('roles.index'), 'permission' => 'role-view'],
                ['name' => 'Permissions', 'url' => route('permissions.index'), 'permission' => 'permission-view'],
                ['name' => 'Audit Logs', 'url' => route('audit-logs.index'), 'permission' => 'audit-log-view'],
                ['name' => 'Organization Types', 'url' => route('organization-types.index'), 'permission' => 'organization-type-view'],
                ['name' => 'Tags', 'url' => route('tag.index'), 'permission' => 'tag-view'],
            ], 'permission' => 'admin-view'],
            ['name' => 'Status Tables', 'url' => '#', 'submenu' => [
                ['name' => 'Case Statuses', 'url' => route('case-statuses.index'), 'permission' => 'case-status-view'],
                ['name' => 'Volunteer Statuses', 'url' => route('volunteer-statuses.index'), 'permission' => 'volunteer-status-view'],
                ['name' => 'Intake Statuses', 'url' => route('intake-statuses.index'), 'permission' => 'intake-status-view'],

            ]],
            ['name' => $userName, 'url' => '#', 'submenu' => [
                ['name' => 'Logout', 'action' => 'logout'],
                ['name' => 'Dashboard Settings', 'url' => route('dashboard.settings')]
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
