<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Schedule;
use Illuminate\Support\Facades\Auth;
class StudentController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        
        $query = Student::query();
    
        if ($search) {
            $query->where('name', 'LIKE', "%$search%")
                  ->orWhere('email', 'LIKE', "%$search%")
                  ->orWhere('phone_number', 'LIKE', "%$search%")
                  ->orWhere('address', 'LIKE', "%$search%");
        }
    
        $students = $query->orderBy('created_at', 'desc')->paginate(5);
    
        return view('admin.students.index', compact('students', 'search'));
    }
    

    public function create()
    {
        return view('admin.students.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone_number' => 'required',
            'address' => 'required',
            // Add validation rules for other fields as needed
        ]);
    
        $student = Student::create($validatedData);
        return redirect()->route('admin.students.index')->with('success', 'Student created successfully.');
    }
    

    public function edit($id)
    {
        $student = Student::findOrFail($id);
        return view('admin.students.edit', compact('student'));
    }

    public function update(Request $request, $id)
    {
        $student = Student::findOrFail($id);
        $student->update($request->all());
        return redirect()->route('admin.students.index')->with('success', 'Student updated successfully.');
    }

    public function destroy($id)
    {
        $student = Student::findOrFail($id);
        $student->delete();
        return redirect()->route('admin.students.index')->with('success', 'Student deleted successfully.');
    }






    public function editProfile()
    {
        $student = Auth::user();
        return view('admin.students.editProfile', compact('student'));
    }

    public function updateProfile(Request $request)
    {
        $student = Auth::user();

        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:students,email,' . $student->id,
            'phone_number' => 'required',
            'address' => 'required',
            // Add validation rules for other fields as needed
        ]);

        $student->update($validatedData);

        return redirect()->route('student.main')->with('success', 'Profile updated successfully.');
    }


    public function viewSchedule()
    {
        $schedules = Schedule::all();
        return view('admin.students.viewSchedule', compact('schedules'));
    }


}

