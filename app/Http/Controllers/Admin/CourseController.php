<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\Major;
use App\Models\Schedule;

class CourseController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');
        $query = Course::orderBy('updated_at', 'desc');

        if ($search) {
            $query->where('name', 'like', '%' . $search . '%');
        }

        $courses = $query->paginate(5);

        return view('admin.courses.index', compact('courses', 'search'));
    }

    public function create()
    {
        $students = Student::all();
        $teachers = Teacher::all();
        $majors = Major::all();
        return view('admin.courses.create', compact('students', 'teachers', 'majors'));
    }

    public function store(Request $request)
    {
        // Validate input here

        $course = Course::create($request->except('student_ids'));
        $course->students()->sync($request->input('student_ids', []));

        return redirect()->route('admin.courses.index')->with('success', 'Course created successfully.');
    }

    public function edit($id)
    {
        $course = Course::findOrFail($id);
        $students = Student::all();
        $teachers = Teacher::all();
        $majors = Major::all();
        return view('admin.courses.edit', compact('course', 'students', 'teachers', 'majors'));
    }

    public function update(Request $request, $id)
    {
        // Validate input here

        $course = Course::findOrFail($id);
        $course->update($request->except('student_ids'));
        $course->students()->sync($request->input('student_ids', []));

        return redirect()->route('admin.courses.index')->with('success', 'Course updated successfully.');
    }

    public function destroy($id)
    {
        $course = Course::findOrFail($id);
        $course->delete();
        return redirect()->route('admin.courses.index')->with('success', 'Course deleted successfully.');
    }

    public function showStudents($id)
    {
        $course = Course::with('students')->findOrFail($id);
        return view('admin.courses.students', compact('course'));
    }

    public function show($id)
    {
        $course = Course::findOrFail($id);
        return view('admin.courses.show', compact('course'));
    }

    public function showStudentsInCourse($id)
    {
        $course = Course::findOrFail($id);
        $students = $course->students;
        return view('admin.courses.students', compact('course', 'students'));
    }

    public function showAddStudentForm($id)
    {
        $course = Course::findOrFail($id);
        $students = Student::all();
        return view('admin.courses.addStudent', compact('course', 'students'));
    }

    public function addStudentToCourse(Request $request, $id)
    {
        $course = Course::findOrFail($id);
        $studentIds = $request->input('student_ids', []);
        $course->students()->syncWithoutDetaching($studentIds);
        return redirect()->route('admin.courses.students', $course->id)->with('success', 'Students added successfully.');
    }



     public function createSchedule($id)
    {
        $course = Course::findOrFail($id);
        return view('admin.courses.createSchedule', compact('course'));
    }
    
    public function storeSchedule(Request $request, $id)
    {
        $course = Course::findOrFail($id);
    
        // Validate input here for the schedule
        $validatedData = $request->validate([
            'day_of_week' => 'required|date',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'room_number' => 'required|string',
        ]);
        
    
        $course->schedules()->create($validatedData);
    
        return redirect()->route('admin.courses.show', $course->id)->with('success', 'Schedule created successfully.');
    }
    
    ///zzz
    public function showSchedule($courseId, $scheduleId)
    {
        $course = Course::findOrFail($courseId);
        $schedule = Schedule::findOrFail($scheduleId);
        return view('admin.courses.showSchedule', compact('course', 'schedule'));
    }


    ///zzz
    public function editSchedule($courseId, $scheduleId)
    {
        $course = Course::findOrFail($courseId);
        $schedule = Schedule::findOrFail($scheduleId);
        return view('admin.courses.editSchedule', compact('course', 'schedule'));
    }

    public function updateSchedule(Request $request, $courseId, $scheduleId)
    {
        $validatedData = $request->validate([
            'day_of_week' => 'required|date',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'room_number' => 'required|string',
        ]);

        $schedule = Schedule::findOrFail($scheduleId);
        $schedule->update($validatedData);

        return redirect()->route('admin.courses.showSchedule', ['course' => $courseId, 'schedule' => $scheduleId])->with('success', 'Schedule updated successfully.');
    }

    
    
    
    public function destroySchedule($courseId, $scheduleId)
    {
        $course = Course::findOrFail($courseId);
        $schedule = Schedule::findOrFail($scheduleId);
        $schedule->delete();
        return redirect()->route('admin.courses.show', $course->id)->with('success', 'Schedule deleted successfully.');
    }

    
    

    // ... other methods ...
}
