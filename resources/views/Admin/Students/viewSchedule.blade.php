<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Student DashBoard</title>
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
                <a href="{{ route('admin.main') }}">
                    <img src="https://th.bing.com/th/id/OIP.OSutm8Wgkof3WBByI7TIdAHaCT?pid=ImgDet&rs=1" alt="Logo">
                </a>
            </p>
        </div>

        <div class="search-box">
            <input type="text" placeholder="Search..."/>
            <p class="fa fa-search"></p>
        </div>

        <menu class="menu">
            <p class="menu-name">Student DashBoard</p>

                    <ul>
                    <a href="{{ route('admin.students.editProfile') }}" class="btn btn-primary">Edit Profile</a>
                    <a href="{{ route('admin.students.viewSchedule') }}" class="btn btn-primary">View Schedule</a>
                    </ul>


   

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
            <h1>Welcome to Student DashBoard !!!!!!! </h1>
        </div>
        <div class="main-content">
  <div class="container">
    <h2>View Schedule</h2>
    
    <!-- Hiển thị thời khóa biểu cho student tại đây -->
    <!-- Ví dụ: -->
    <table class="table">
        <thead>
            <tr>
                <th>Day</th>
                <th>Start Time</th>
                <th>End Time</th>
                <th>Course</th>
                <th>Room Number</th>
            </tr>
        </thead>
        <tbody>
            @foreach($schedules as $schedule)
            <tr>
                <td>{{ $schedule->day_of_week }}</td>
                <td>{{ $schedule->start_time }}</td>
                <td>{{ $schedule->end_time }}</td>
                <td>{{ $schedule->course->name }}</td>
                <td>{{ $schedule->room_number }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
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
