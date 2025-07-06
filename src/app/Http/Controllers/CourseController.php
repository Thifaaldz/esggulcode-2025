<?php

namespace App\Http\Controllers;

use App\Models\EventCourse;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index()
    {
        $courses = EventCourse::all();
        return view('courses', compact('courses'));
    }
}
