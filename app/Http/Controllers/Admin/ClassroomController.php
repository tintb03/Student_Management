<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Classroom;
use App\Models\Teacher;
use App\Models\Major;

class ClassroomController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');
        $query = Classroom::orderBy('updated_at', 'desc');
    
        if ($search) {
            $query->where('name', 'like', '%' . $search . '%');
        }
    
        $classrooms = $query->paginate(5);
    
        return view('admin.classrooms.index', compact('classrooms', 'search'));
    }
    

    public function create()
    {
        $teachers = Teacher::all();
        $majors = Major::all();
        return view('admin.classrooms.create', compact('teachers', 'majors'));
    }

    public function store(Request $request)
    {
        // Validate input here

        $classroom = Classroom::create($request->all());
        return redirect()->route('admin.classrooms.index')->with('success', 'Classroom created successfully.');
    }

    public function edit($id)
    {
        $classroom = Classroom::findOrFail($id);
        $teachers = Teacher::all();
        $majors = Major::all();
        return view('admin.classrooms.edit', compact('classroom', 'teachers', 'majors'));
    }

    public function update(Request $request, $id)
    {
        // Validate input here

        $classroom = Classroom::findOrFail($id);
        $classroom->update($request->all());
        return redirect()->route('admin.classrooms.index')->with('success', 'Classroom updated successfully.');
    }

    public function destroy($id)
    {
        $classroom = Classroom::findOrFail($id);
        $classroom->delete();
        return redirect()->route('admin.classrooms.index')->with('success', 'Classroom deleted successfully.');
    }
}
