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
                ['label' => 'Roles', 'route' => 'roles','auth' => 'Super User'],     
                ['label' => 'Users', 'route' => 'corpUsers','auth' => true],
                
                ['label' => 'Meeting Status', 'route' => 'meetingStatus','auth' => 'Super User'],
                ['label' => 'Meeting Interval', 'route' => 'meetingInterval','auth' => 'Super User'],
                ['label' => 'Meeting Locations', 'route' => 'meetingLocation','auth' => true],

                ['label' => 'Meeting Delegate Roles', 'route' => 'meetingDelegateRole','auth' => 'Super User'],
                ['label' => 'Meeting Attendee Status', 'route' => 'meetingAttendeeStatus','auth' => 'Super User'],
                ['label' => 'Meeting Action Status', 'route' => 'meetingMinuteActionStatus','auth' => 'Super User'],
            ],
        ],
        [
            'label' => 'About Us',
            'route' => 'underDevelopment',
            'auth' => true,
            'submenus' => [],
        ],
        [
            'label' => 'Contact Us',
            'route' => 'underDevelopment',
            'auth' => true,
            'submenus' => [],
        ],
        [
            'label' => 'Terms',
            'route' => 'underDevelopment',
            'auth' => true,
            'submenus' => [],
        ],
    ];

    public function render()
    {
        return view('ezimeeting::livewire.menus.menu');
    }
}