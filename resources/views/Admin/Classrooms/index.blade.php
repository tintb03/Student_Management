<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin DashBoard</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
 	<style type="text/css">
        /* CSS cho thanh sidebar */
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-color: #f1f1f1;
        }

        .table th,
        .table td {
            padding: 8px;
            text-align: left;
            border: 1px solid #ddd;
        }

        .table th {
            background-color: #f2f2f2;
        }

        .table tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .table tr:hover {
            background-color: #ddd;
        }

        .actions {
            display: flex;
            gap: 5px;
        }

        ul {
            list-style-type: none;
            padding-left: 1px; /* Điều chỉnh giá trị theo mong muốn */
            padding-left: 0px;
 
        }

        li {
            padding-left: 20px; /* Điều chỉnh giá trị theo mong muốn */
        }


        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            bottom: 0;
            width: 250px;
            background: #FFFFFF;
        }

        .sidebar .top-bar {
            background: #FFFFFF;
            overflow: hidden;
            text-align: center;
        }

        .sidebar .top-bar .logo img {
            width: 250px; /* Điều chỉnh kích thước theo ý muốn */
            height: auto;
        }

        .sidebar .search-box {
            background: #FFFAF0;
            padding: 20px;
            position: relative;
        }

        /* ... (các phần CSS khác cho sidebar) ... */

        /* Định dạng cho phần tạo khoảng cách */
        .separator {
            border-top: 1px solid #111111;
            border-bottom: 1px solid #353535;
            margin: 20px;
        }

        /* Định dạng cho liên kết trong menu */
        .menu{
            padding-left: 20px;
        }
        .menu a {
            
            text-decoration: none;
        }

        .menu a:hover {
            color: Red;
        }

        /* ... (các phần CSS khác cho menu) ... */

        /* CSS cho phần nội dung chính */
        .main {

            margin-left: 250px; /* Khoảng cách với sidebar */
        }

        .navbar {
            background: #FFFACD;
            color: #FFF;
            text-align: center;
            margin: 0px;
            height: 50px;
        }

        .top-bar {
            background: #3AB0FF;
            color: #FFF;
            padding: 10px 0;
            text-align: center;
        }

        .main-content {
            background: #FFF;
            padding: 20px;
            border-radius: 5px;
            height: 780px;
            
            /* background-image: url("https://btec.fpt.edu.vn/wp-content/uploads/2022/07/LogoBTEC-1536x1268.png");
            background-size: cover;
            background-repeat: no-repeat; */
        }

                /* Đặt kích thước ảnh theo tỷ lệ */
        img {
            width: 50%; /* Điều chỉnh kích thước chiều rộng dựa trên tỷ lệ phần trăm */
            height: auto; /* Tự điều chỉnh chiều cao để duy trì tỷ lệ */
            display: block;
            margin: auto;
        }


        footer {
            background-color: #333;
            color: #fff;
            text-align: center;
            padding: 10px;
            position: fixed;
            bottom: 0;
            width: 100%;
        }

        
    </style>
</head>
<body>
    <aside class="sidebar">
        <div class="top-bar">
            <p class="logo">
                <a href="#">
                    <img src="https://th.bing.com/th/id/OIP.OSutm8Wgkof3WBByI7TIdAHaCT?pid=ImgDet&rs=1" alt="Logo">
                </a>
            </p>
        </div>

        <div class="search-box">
            <input type="text" placeholder="Search..."/>
            <p class="fa fa-search"></p>
        </div>

        <menu class="menu">
            <p class="menu-name">Admin DashBoard</p>
            <ul>
                                <li><a href="{{ route('admin.accounts.index') }}">View Accounts</a></li>
                                <li><a href="{{ route('admin.accounts.create') }}">Create Account</a></li>
                            </ul>

                    <p class="menu-name">Quản Lý Chuyên Ngành</p>
                            <ul>
                                <li><a href="{{ route('admin.majors.index') }}">View Majors</a></li>
                                <li><a href="{{ route('admin.majors.create') }}">Create Majors</a></li>
                            </ul>
                    <ul>

                    <p class="menu-name">Quản Lý Giáo Viên</p>
                            <ul>
                                <li><a href="{{ route('admin.teachers.index') }}">View Teacher</a></li>
                                <li><a href="{{ route('admin.teachers.create') }}">Create Teacher</a></li>
                            </ul>
                    <ul>
                        
                    <p class="menu-name">Quản Lý Lớp Học</p>
                            <ul>
                                <li><a href="{{ route('admin.classrooms.index') }}">View ClassRooms</a></li>
                                <li><a href="{{ route('admin.classrooms.create') }}">Create ClassRoom</a></li>
                            </ul>
                    <ul>
                    <hr/>
                    <p class="menu-name">Quản Lý Courses</p>
                            <ul>
                                <li><a href="{{ route('admin.courses.index') }}">View Courses</a></li>
                                <li><a href="{{ route('admin.courses.create') }}">Create Courses</a></li>

                            </ul>
                    <ul>
                    <p class="menu-name">Quản Lý Sinh Viên</p>
                            <ul>
                                <li><a href="{{ route('admin.students.index') }}">View Student</a></li>
                                <li><a href="{{ route('admin.students.create') }}">Create Student</a></li>
                            </ul>
                    <ul>
                        

                <!-- <li class="active">
                    <p href="#">Teacher Account Management</a>
                    <ul>
                        <li><a href="#">Views Account</a></li>
                        <li><a href="#">Create Account</a></li>
                        <li><a href="#">Update Account</a></li>

                    </ul>
                </li>

                <li class="active">
                    <p href="#">Student Account Management</a>
                    <ul>
                        <li><a href="#">Views Account</a></li>
                        <li><a href="#">Create Account</a></li>
                        <li><a href="#">Update Account</a></li>

                    </ul>
                </li>
                <li><a href="#">Animation</a></li> -->

            </ul>
<!-- 
            <div class="separator"></div>

            <ul class="no-bullets">
                <li><a href="#">Latest news</a></li>
                <li><a href="#">Critic reviews</a></li>
                <li><a href="#">Box office</a></li>
                <li><a href="#">Top 250</a></li>
            </ul>

            <div class="separator"></div> -->
        </menu>
    </aside>



     <div class="main">

     	   <div class="navbar">
				<nav class="navbar navbar-inverse">
				  <div class="container-fluid">
				    <div class="navbar-header">
				      <a class="navbar-brand" href="#">WebSiteName</a>
				    </div>

				    <ul class="nav navbar-nav navbar-right">
				      <!-- <li><a href="#"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li> -->
				      <li><a href="{{ route('logout') }}" onclick="event.preventDefault(); logoutConfirmation();"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
				    </ul>
				  </div>
				</nav>
				  
    </div>

        <div class="top-bar">
        <h1>Class Management</h1>
        </div>
        <div class="main-content">

                    <div class="container">
                <h2>Manage Classrooms</h2>

                                <div class="row">
                    <div class="col-md-6">
                        <form action="{{ route('admin.classrooms.index') }}" method="GET" class="form-inline">
                            <div class="form-group">
                                <input type="text" name="search" class="form-control" placeholder="Search...">
                            </div>
                            <button type="submit" class="btn btn-primary">Search</button>
                        </form>
                    </div>
                    <div class="col-md-6 text-right">
                        <a href="{{ route('admin.classrooms.create') }}" class="btn btn-success">Add Classroom</a>
                    </div>
                </div>


                @if ($classrooms->isEmpty())
                    <p>No classrooms found.</p>
                @else
                <table class="table" style="margin-top: 30px;">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Teacher</th>
                                <th>Major</th>
                                <th>Actions</th>
                                <th>Management</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($classrooms as $classroom)
                                <tr>
                                    <td>{{ $classroom->id }}</td>
                                    <td>{{ $classroom->name }}</td>
                                    <td>{{ $classroom->teacher->name }}</td>
                                    <td>{{ $classroom->major->name }}</td>
                                    <td>
                                        <a href="{{ route('admin.classrooms.edit', $classroom->id) }}" class="btn btn-primary">Edit</a>
                                        <form action="{{ route('admin.classrooms.destroy', $classroom->id) }}" method="POST" style="display: inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this classroom?')">Delete</button>
                                    <td>
                                        <!-- Xem sinh viên của lớp học -->
                                        <a href="{{ route('admin.classrooms.students', $classroom->id) }}" class="btn btn-info">View Students</a>
                                        
                                        <!-- Thêm sinh viên vào lớp học -->
                                        <a href="{{ route('admin.classrooms.add-student', $classroom->id) }}" class="btn btn-primary">Add Student</a>
                                        
                                        <!-- Điểm danh sinh viên -->
                                        <a href="{{ route('admin.classrooms.mark-attendance', $classroom->id) }}" class="btn btn-warning">Mark Attendance</a>
                                    </td>
                                        </form>
                                    </td>
  
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                                            @if ($search)
                            <p>Search results for: <strong>{{ $search }}</strong></p>
                        @endif
                    {{ $classrooms->links() }}
                @endif
            </div>

        </div>



    <footer>
        <p style="margin-right: 240px;">© 2023 Your Website. All rights reserved.</p>
    </footer>

    <script>
    function logoutConfirmation() {
        if (confirm('Are you sure you want to log out?')) {
            window.location.href = "{{ route('logout') }}";
        }
    }
</script>

</body>
</html>
