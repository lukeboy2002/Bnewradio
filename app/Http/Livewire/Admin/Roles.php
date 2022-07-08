<?php

namespace App\Http\Livewire\Admin;

use App\Models\Role;
use Livewire\Component;

class Roles extends Component
{
    public $showModal = false;

    public function render()
    {
        $roles = Role::with('permissions')->get();

        return view('livewire.admin.roles', [
            'roles' => $roles
        ]);
    }

    public function deleteId($id)
    {
        $this->showModal = true;
        $this->deleteId = $id;
    }

    public function delete()
    {
        Role::find($this->deleteId)->delete();
        $this->showModal = false;

        return redirect()->to('/');
    }

    public function close()
    {
        $this->showModal = false;

    }
}
