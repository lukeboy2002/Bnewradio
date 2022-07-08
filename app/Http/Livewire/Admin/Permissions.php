<?php

namespace App\Http\Livewire\Admin;

use App\Models\Permission;
use Livewire\Component;

class Permissions extends Component
{
    public $showModal = false;

    public function render()
    {
        $permissions = Permission::with('roles')->get();

        return view('livewire.admin.permissions', [
            'permissions' => $permissions,
        ]);
    }

    public function deleteId($id)
    {
        $this->showModal = true;
        $this->deleteId = $id;
    }

    public function delete()
    {
        Permission::find($this->deleteId)->delete();
        $this->showModal = false;
    }

    public function close()
    {
        $this->showModal = false;
    }
}
