<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login - GetJobs</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
  <!-- Font Awesome -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Poppins', sans-serif;
    }

    body {
      display: flex;
      height: 100vh;
      background: #fff;
    }

    .left {
      flex: 1;
      background: #ECEFEC;
      display: flex;
      justify-content: center;
      align-items: center;
      position: relative;
      overflow: hidden;
    }

    .left img {
      width: 140%;
      height: auto;
      object-fit: contain;
      transform: translateY(27px); /* biar napak bawah */
    }

    .right {
      flex: 1;
      display: flex;
      justify-content: center;
      align-items: center;
      padding: 40px;
    }

    .form-box {
      width: 100%;
      max-width: 400px;
    }

    h2 {
      font-size: 28px;
      font-weight: 700;
      margin-bottom: 25px;
      text-align: center;
      color: #2F4157;
    }

    .input-group {
      position: relative;
      margin-bottom: 20px;
    }

    .input-group input {
      width: 100%;
      padding: 12px 15px 12px 40px; /* padding kiri buat ikon */
      border: 1px solid #ccc;
      border-radius: 8px;
      font-size: 14px;
      outline: none;
    }

    .input-group i {
      position: absolute;
      top: 50%;
      left: 12px;
      transform: translateY(-50%);
      color: #577C8E;
      font-size: 16px;
    }

    .forgot {
      text-align: right;
      font-size: 12px;
      margin-top: -10px;
      margin-bottom: 20px;
    }

    .forgot a {
      color: #577C8E;
      text-decoration: none;
      font-weight: 500;
    }

    .btn {
      width: 100%;
      padding: 12px;
      border: none;
      border-radius: 8px;
      background: #000000ff;
      color: #fff;
      font-size: 16px;
      font-weight: 600;
      cursor: pointer;
      margin-bottom: 20px;
    }

    .or {
      text-align: center;
      margin-bottom: 15px;
      color: #666;
    }

    .social {
      display: flex;
      justify-content: center;
      gap: 20px;
      margin-bottom: 20px;
    }

    .social a {
      font-size: 20px;
      text-decoration: none;
      color: #000;
      font-weight: bold;
    }

    .register-link {
      text-align: center;
      font-size: 14px;
    }

    .register-link a {
      font-weight: 600;
      color: #2F4157;
      text-decoration: none;
    }
  </style>
</head>
<body>
  <div class="left">
    <img src="{{ asset('images/person.png') }}" alt="person Image">
  </div>

  <div class="right">
    <div class="form-box">
      <h2>Sign In</h2>
      <form method="POST" action="{{ route('login.process') }}">
        @csrf
        <div class="input-group">
          <i class="fa-solid fa-envelope"></i>
          <input type="email" name="email" placeholder="Email" required>
        </div>
        <div class="input-group">
          <i class="fa-solid fa-lock"></i>
          <input type="password" name="password" placeholder="Password" required>
        </div>
        <div class="forgot">
          <a href="#">Forgot password?</a>
        </div>
   <a href ="{{ route (name:'profil')}}" <button type="submit" class="btn">Sign In</button>
      </form>

      <div class="or">or continue with :</div>
      <div class="social">
        <a href="#"><i class="fa-brands fa-google"></i></a>
        <a href="#"><i class="fa-brands fa-instagram"></i></a>
        <a href="#"><i class="fa-brands fa-facebook-f"></i></a>
      </div>

      <div class="register-link">
        Belum punya akun? <a href="{{ route('register.form') }}">Daftar</a>
      </div>
    </div>
  </div>
</body>
</html>
