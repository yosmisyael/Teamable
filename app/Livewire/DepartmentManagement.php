<?php

namespace App\Livewire;

use App\Models\Department;
use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('components.layouts.admin')]
class DepartmentManagement extends Component
{
    use WithPagination;

    protected $paginationTheme = 'tailwind';

    #[Title('Department Management')]

    public bool $isFormOpen = false;

    #[Rule('required|string:max:255')]
    public string $name = '';

    public function toggleForm(): void {
        $this->isFormOpen = !$this->isFormOpen;
        if ($this->isFormOpen) {
            $this->reset('name');
        }
    }

    public function saveDepartment(): void {
        $this->validate([
            'name' => 'required|string|max:255',
        ]);

        Department::query()->create([
            'name' => $this->name,
        ]);

        $this->toggleForm();

        session()->flash('success', 'Department successfully created!');
    }

    public function render(): View
    {
        return view('livewire.department-management', [
            'departments' => Department::query()->latest()->paginate(5),
        ]);
    }
}
