<?php

namespace Mudtec\Ezimeeting\Livewire\Menus;

use Livewire\Component;

class Menu extends Component
{
    public $menuItems = [
        [
            'label' => 'Meetings',
            'route' => '#',
            'auth' => 'Organizer|Attendee',
            'submenus' => [
                ['label' => 'Create Meeting', 'route' => 'underDevelopment', 'auth' => 'Organizer'],
                ['label' => 'My Meetings', 'route' => 'underDevelopment','auth' => true],
                ['label' => 'All Meetings', 'route' => 'underDevelopment','auth' => true],
                ['label' => 'Meeting Schedule', 'route' => 'underDevelopment','auth' => true],
                ['label' => 'Meeting Report', 'route' => 'underDevelopment','auth' => true],
            ],
        ],
        [
            'label' => 'Admin',
            'route' => '#',
            'auth' => 'Super User|Admin',
            'submenus' => [
                ['label' => 'Corporations', 'route' => 'corporations','auth' => true],
                ['label' => 'Corporate Users', 'route' => 'corporationsUser', 'auth' => true], 
                ['label' => 'Departments', 'route' => 'corpDepartments','auth' => true],
                ['label' => 'Managers', 'route' => 'departmentManagers','auth' => true],
                ['label' => 'Roles', 'route' => 'roles','auth' => true],
                
                ['label' => 'Users', 'route' => 'corpUsers','auth' => true],

                
                ['label' => 'Meeting Status', 'route' => 'meetingStatus','auth' => true],
                ['label' => 'Meeting Interval', 'route' => 'meetingInterval','auth' => true],
                ['label' => 'Meeting Locations', 'route' => 'underDevelopment','auth' => true],
                ['label' => 'Meeting Roles', 'route' => 'underDevelopment','auth' => true],
                
                ['label' => 'Attendee Option', 'route' => 'underDevelopment','auth' => true],
            ],
        ],
        [
            'label' => 'About Us',
            'route' => '/about',
            'auth' => true,
            'submenus' => [],
        ],
        [
            'label' => 'Contact Us',
            'route' => '/contact',
            'auth' => true,
            'submenus' => [],
        ],
        [
            'label' => 'Terms',
            'route' => '/terms',
            'auth' => true,
            'submenus' => [],
        ],
    ];

    public function render()
    {
        return view('ezimeeting::livewire.menus.menu');
    }
}