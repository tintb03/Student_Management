
<div class="container">
    <h2>Manage Courses</h2>

    @if ($courses->isEmpty())
    <p>No courses found.</p>
    @else
    <table class="table" style="margin-top: 30px;">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Teacher</th>
                <th>Major</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($courses as $course)
            <tr>
                <td>{{ $course->id }}</td>
                <td>{{ $course->name }}</td>
                <td>{{ $course->teacher ? $course->teacher->name : 'N/A' }}</td>
                <td>{{ $course->major ? $course->major->name : 'N/A' }}</td>

                <td>
                    <a href="{{ route('admin.courses.show', $course->id) }}" class="btn btn-info btn-sm">Details</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif
</div>

