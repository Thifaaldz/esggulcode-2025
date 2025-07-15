<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class TrainerController extends Controller
{
    public function index()
    {
        $trainers = Employee::whereHas('user.roles', function ($query) {
            $query->where('name', 'instructor');
        })->with(['position', 'division'])->get();

        return view('front.trainers', compact('trainers'));
    }
}
