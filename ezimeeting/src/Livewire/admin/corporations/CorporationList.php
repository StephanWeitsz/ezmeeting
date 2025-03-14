<?php

namespace Mudtec\Ezimeeting\Livewire\Admin\Corporations;

use Mudtec\Ezimeeting\Models\Corporation;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\WithPagination;

class CorporationList extends Component
{
    use WithPagination;

    public $showEditForm = false;
    public $editingCorporation;

    public $search;

    public $page_heading = 'Corporations';
    public $page_sub_heading = 'All companies';

    public function delete($corporation) {
        try {
            Corporation::findOrfail($corporation)->delete();
        } catch(Exception $e) {
            request()->session()->flash('error', 'Delete Failed!');
            return;
        }
    }

    public function edit(Corporation $corporation)
    {
        $this->showEditForm = true;
        $this->editingCorporation = $corporation;
    }

    public function render()
    {
        return view('ezimeeting::livewire.corporations.corporation-list', [
            'corporations' => Corporation::latest()->where('name', 'ilike', "%{$this->search}%")->paginate(20)
        ]);
    } //public function render()
}
