<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login and Register</title>
  <!-- Thêm CSS của Bootstrap -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <style>
    /* Tùy chỉnh CSS cho modal */
    .modal-dialog {
      display: flex;
      align-items: center;
      justify-content: center;
      height: 100vh;
    }

            /* Tùy chỉnh background cho trang */
            body {
      background-image: url('https://th.bing.com/th/id/R.b5f4e62f0ad0a56bb8c9d961694340a6?rik=%2boIQhW%2fKTbSAgg&riu=http%3a%2f%2fwww.oracletrainingsolutions.co.uk%2fwp-content%2fuploads%2f2018%2f11%2fBTEC-LOGO.png&ehk=ukgkbn0awU9KYyu4FVyxg7D%2fDFDpM6jAUDgqJd8kow0%3d&risl=&pid=ImgRaw&r=0&sres=1&sresct=1');
      background-size: cover;
      background-repeat: no-repeat;
      background-attachment: fixed;
    }
  </style>
</head>
<body>
<!-- Button để mở modal đăng nhập -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#loginModal">
  Open Login Modal
</button>

<!-- Button để mở modal đăng ký -->
<button type="button" class="btn btn-success" data-toggle="modal" data-target="#registerModal">
  Open Register Modal
</button>

<!-- Modal đăng nhập -->
<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="loginModalLabel">Login</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <!-- Đặt nội dung form đăng nhập ở đây -->
            <form method="POST" action="{{ route('login') }}">
              @csrf
              <div class="form-group">
                <label for="loginEmail">Email</label>
                <input type="email" class="form-control" id="loginEmail" name="email" required>
              </div>
              <div class="form-group">
                <label for="loginPassword">Password</label>
                <input type="password" class="form-control" id="loginPassword" name="password" required>
              </div>
              <div class="form-group">
                <label for="loginRole">Role</label>
                <select class="form-control" id="loginRole" name="role" required>
                  <option value="admin">Admin</option>
                  <option value="teacher">Teacher</option>
                  <option value="student">Student</option>
                </select>
              </div>
              <button type="submit" class="btn btn-primary">Login</button>
            </form>
          </div>
        </div>
      </div>
</div>

<!-- Modal đăng ký -->
<div class="modal fade" id="registerModal" tabindex="-1" role="dialog" aria-labelledby="registerModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="registerModalLabel">Register</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <!-- Đặt nội dung form đăng ký ở đây -->
            <form method="POST" action="{{ route('register') }}">
              @csrf
              <div class="form-group">
                <label for="regDisplayName">Display Name</label>
                <input type="text" class="form-control" id="regDisplayName" name="display_name" required>
              </div>
              <div class="form-group">
                <label for="regEmail">Email</label>
                <input type="email" class="form-control" id="regEmail" name="email" required>
              </div>
              <div class="form-group">
                <label for="regPassword">Password</label>
                <input type="password" class="form-control" id="regPassword" name="password" required>
              </div>
              <div class="form-group">
                <label for="regConfirmPassword">Confirm Password</label>
                <input type="password" class="form-control" id="regConfirmPassword" name="password_confirmation" required>
              </div>
              <button type="submit" class="btn btn-success">Register</button>
            </form>
          </div>
        </div>
      </div>
</div>

<!-- Thêm JavaScript của Bootstrap -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
