<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Classroom;
use App\Models\Teacher;
use App\Models\Major;
use App\Models\Student;
use Illuminate\Support\Facades\Session;

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

    public function show($id, Request $request)
    {
        $classroom = Classroom::with(['students' => function ($query) use ($request) {
            $query->orderBy('updated_at', 'desc');
    
            $search = $request->query('search');
            if ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', '%' . $search . '%')
                      ->orWhere('email', 'like', '%' . $search . '%');
                });
            }
        }])->findOrFail($id);
    
        return view('admin.classrooms.students', compact('classroom'));
    }
    
    

    public function addStudent($id)
    {
        $classroom = Classroom::findOrFail($id);
        $students = Student::all();
        return view('admin.classrooms.add-student', compact('classroom', 'students'));
    }

    public function storeStudent(Request $request, $id)
    {
        $classroom = Classroom::findOrFail($id);
        $studentId = $request->input('student_id');
        
        // Kiểm tra xem sinh viên đã tồn tại trong lớp hay chưa
        if (!$classroom->students->contains($studentId)) {
            $classroom->students()->attach($studentId, ['is_present' => false]);
        }
        
        Session::flash('success', 'Student added successfully.');
        return redirect()->route('admin.classrooms.students', ['classroom' => $classroom->id]);
    }
    

    public function markAttendance($id)
    {
        $classroom = Classroom::with('students')->findOrFail($id);
        return view('admin.classrooms.mark-attendance', compact('classroom'));
    }

    public function storeAttendance(Request $request, $id)
    {
        $classroom = Classroom::findOrFail($id);
        $attendanceData = $request->input('attendance', []);

        foreach ($classroom->students as $student) {
            $isPresent = isset($attendanceData[$student->id]) ? true : false;
            $classroom->students()->updateExistingPivot($student->id, ['is_present' => $isPresent]);
        }

        return redirect()->route('admin.classrooms.show', $classroom->id)->with('success', 'Attendance marked successfully.');
    }


        public function removeStudent($classroomId, $studentId)
    {
        $classroom = Classroom::findOrFail($classroomId);
        $classroom->students()->detach($studentId);

        return redirect()->route('admin.classrooms.show', $classroom->id)->with('success', 'Student removed from classroom.');
    }

}
