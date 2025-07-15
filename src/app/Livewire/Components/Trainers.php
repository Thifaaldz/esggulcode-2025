<?php
namespace App\Livewire\Components;

use App\Models\Employee;
use Livewire\Component;

class Trainers extends Component
{
    public function render()
    {
        $trainers = Employee::with(['user.roles', 'position', 'division'])
            ->whereHas('user.roles', fn ($query) => $query->where('name', 'instructor'))
            ->get();

        return view('livewire.components.trainers', compact('trainers'));
    }
}
