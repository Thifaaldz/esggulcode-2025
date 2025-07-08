<?php

namespace App\Livewire;

use App\Models\Employee;
use Livewire\Component;

class TrainersIndex extends Component
{
    public function render()
    {
        // Ambil hanya yang user-nya punya role 'instructor'
        $employees = Employee::whereHas('user.roles', function ($q) {
            $q->where('name', 'instructor');
        })
        ->with(['user', 'branch', 'position'])
        ->get();

        return view('livewire.trainers-index', [
            'employees' => $employees,
        ]);
    }
}
