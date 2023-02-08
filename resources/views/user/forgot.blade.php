<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
<div class="container">
  <div class="card">
    <div class="card-body">
      <div class="row">
        <div class="col-12">
          <h1>Hello!</h1>
          <h3>You are receiving this email because we received a password reset request for your account</h3>
        </div>
      </div>
      <div class="col-12">
        You can reset password now
        <a href="{{ route('reset_password_link', $token) }}" class="btn btn-success fw-bold">Reset Password</a>
      </div>
    </div>
  </div>
</div>
</body>
</html>