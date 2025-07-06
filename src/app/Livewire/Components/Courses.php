<?php

namespace App\Livewire\Components;

use App\Models\EventCourse;
use Livewire\Component;

class Courses extends Component
{
    public $courses;

    public function mount()
    {
        $this->courses = EventCourse::all();
    }

    public function render()
    {
        return view('livewire.components.courses', [
            'courses' => $this->courses,
        ]);
    }
}
