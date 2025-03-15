<?php

namespace Mudtec\Ezimeeting\Livewire\Admin\Corporations;

use Livewire\Component;
use Livewire\WithPagination;

//use App\Models\User;
use Mudtec\Ezimeeting\Models\User;
use Mudtec\Ezimeeting\Models\Corporation;

class CorporationUser extends Component
{
    use WithPagination;

    public $corporations;
    public $selectedCorporation;

    public $users;
    public $assignedUsers = [];

    public $page_heading = 'Corporation Users';
    public $page_sub_heading = 'Assign and Manage Corporation Users';
    
    public function mount()
    {
        $this->corporations = Corporation::all();
        $this->users = collect();
    }

    public function onCorporationSelected($corporationId)
    {
        $this->selectedCorporation = $corporationId;
    
        $corporation = Corporation::find($corporationId);
                
        $this->users = User::whereDoesntHave('corporations', function ($query) use ($corporationId) {
            $query->where('corporations.id', '<>', $corporationId);
        })
        ->get();

        $this->assignedUsers = $corporation ? $corporation->users->pluck('id')->toArray() : [];
    }
    
    public function saveAssignments()
    {
        $corporation = Corporation::find($this->selectedCorporation);

        if ($corporation) {
            // Sync the assigned users
            $corporation->users()->sync($this->assignedUsers);
            session()->flash('success', 'User assignments updated successfully!');
        } else {
            session()->flash('error', 'Please select a corporation before saving.');
        }
    }

    public function render()
    {
        return view('ezimeeting::livewire.admin.corporations.corporation-user');
    }
}