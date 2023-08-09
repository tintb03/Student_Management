<h2>Mark Attendance for {{ $classroom->name }}</h2>
    <form action="{{ route('admin.classrooms.store-attendance', $classroom->id) }}" method="post">
        @csrf
        @foreach($classroom->students as $student)
            <label>
                <input type="checkbox" name="attendance[{{ $student->id }}]" value="1">
                {{ $student->name }}
            </label><br>
        @endforeach
        <button type="submit">Submit Attendance</button>
    </form>