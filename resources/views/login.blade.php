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
      background: #e8e8e8;
      display: flex;
      justify-content: center;
      align-items: center;
      position: relative;
      overflow: hidden;
    }

    /* Background circles - outer white and inner gray */
    .left::before {
      content: '';
      position: absolute;
      width: 440px;
      height: 440px;
      background: rgba(255, 255, 255, 0.9);
      border-radius: 50%;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      z-index: 1;
    }

    .left::after {
      content: '';
      position: absolute;
      width: 350px;
      height: 350px;
      background: #e8e8e8;
      border-radius: 50%;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      z-index: 1;
    }

    .left img {
      width: 55%;
      height: 55%;
      object-fit: cover;
      object-position: center;
      position: relative;
      z-index: 2;
      border-radius: 50%;
      box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15);
    }

    /* Floating decorative elements */
    .floating-element {
      position: absolute;
      z-index: 3;
      animation: float 3s ease-in-out infinite;
    }

    .chart-icon {
      top: 35%;
      left: 25%;
      width: 60px;
      height: 40px;
      background: #fff;
      border-radius: 8px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
      display: flex;
      align-items: center;
      justify-content: center;
      animation: float 4s ease-in-out infinite;
    }

    .stats-card {
      top: 25%;
      right: 25%;
      width: 80px;
      height: 50px;
      background: #fff;
      border-radius: 8px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
      animation: float 3.5s ease-in-out infinite reverse;
    }

    .progress-bar {
      bottom: 35%;
      left: 20%;
      width: 70px;
      height: 30px;
      background: #fff;
      border-radius: 6px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
      animation: float 4.5s ease-in-out infinite;
    }

    .graph-element {
      bottom: 20%;
      right: 30%;
      width: 60px;
      height: 40px;
      background: #fff;
      border-radius: 8px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
      animation: float 3.8s ease-in-out infinite reverse;
    }

    /* Floating animation */
    @keyframes float {
      0%, 100% {
        transform: translateY(0px);
        opacity: 0.7;
      }
      50% {
        transform: translateY(-15px);
        opacity: 1;
      }
    }

    /* Chart bars inside chart icon */
    .chart-bars {
      display: flex;
      align-items: end;
      gap: 3px;
      height: 20px;
    }

    .bar {
      width: 4px;
      background: linear-gradient(to top, #4ade80, #22c55e);
      border-radius: 2px;
    }

    .bar:nth-child(1) { height: 60%; }
    .bar:nth-child(2) { height: 80%; }
    .bar:nth-child(3) { height: 100%; }
    .bar:nth-child(4) { height: 70%; }
    .bar:nth-child(5) { height: 90%; }

    .right {
      flex: 1;
      display: flex;
      justify-content: center;
      align-items: center;
      padding: 60px;
      background: #fff;
    }

    .form-box {
      width: 100%;
      max-width: 350px;
    }

    h2 {
      font-size: 32px;
      font-weight: 700;
      margin-bottom: 40px;
      text-align: center;
      color: #333;
    }

    .input-group {
      position: relative;
      margin-bottom: 25px;
    }

    .input-group input {
      width: 100%;
      padding: 15px 20px 15px 45px;
      border: 1px solid #e0e0e0;
      border-radius: 8px;
      font-size: 15px;
      outline: none;
      transition: border-color 0.3s ease;
      background: #fff;
    }

    .input-group input:focus {
      border-color: #007bff;
    }

    .input-group input::placeholder {
      color: #999;
      font-weight: 400;
    }

    .input-group i {
      position: absolute;
      top: 50%;
      left: 15px;
      transform: translateY(-50%);
      color: #999;
      font-size: 16px;
    }

    .forgot {
      text-align: right;
      font-size: 13px;
      margin-top: -15px;
      margin-bottom: 30px;
    }

    .forgot a {
      color: #999;
      text-decoration: none;
      font-weight: 400;
    }

    .forgot a:hover {
      color: #007bff;
    }

    .btn {
      width: 100%;
      padding: 15px;
      border: none;
      border-radius: 8px;
      background: #000;
      color: #fff;
      font-size: 16px;
      font-weight: 600;
      cursor: pointer;
      margin-bottom: 25px;
      transition: background-color 0.3s ease;
    }

    .btn:hover {
      background: #333;
    }

    .or {
      text-align: center;
      margin-bottom: 20px;
      color: #999;
      font-size: 14px;
      font-weight: 400;
    }

    .social {
      display: flex;
      justify-content: center;
      gap: 25px;
      margin-bottom: 25px;
    }

    .social a {
      font-size: 22px;
      text-decoration: none;
      color: #666;
      transition: color 0.3s ease;
    }

    .social a:hover {
      color: #333;
    }

    .register-link {
      text-align: center;
      font-size: 14px;
      color: #666;
    }

    .register-link a {
      font-weight: 600;
      color: #333;
      text-decoration: none;
    }

    .register-link a:hover {
      color: #007bff;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
      body {
        flex-direction: column;
      }
      
      .left {
        flex: 0.4;
        min-height: 200px;
      }
      
      .left img {
        width: 60%;
        max-width: 250px;
      }
      
      .right {
        flex: 0.6;
        padding: 30px;
      }
      
      .form-box {
        max-width: 100%;
      }
      
      h2 {
        font-size: 28px;
        margin-bottom: 30px;
      }
    }
  </style>
</head>
<body>
  <div class="left">
    <!-- Background decorative elements -->
    <div class="floating-element chart-icon">
      <div class="chart-bars">
        <div class="bar"></div>
        <div class="bar"></div>
        <div class="bar"></div>
        <div class="bar"></div>
        <div class="bar"></div>
      </div>
    </div>
    
    <div class="floating-element stats-card">
      <div style="padding: 8px; font-size: 10px; color: #666;">
        <div style="display: flex; gap: 2px; margin-bottom: 4px;">
          <div style="width: 4px; height: 4px; background: #22c55e; border-radius: 50%;"></div>
          <div style="width: 4px; height: 4px; background: #f59e0b; border-radius: 50%;"></div>
          <div style="width: 4px; height: 4px; background: #ef4444; border-radius: 50%;"></div>
        </div>
        <div style="height: 2px; background: #e5e7eb; border-radius: 1px; margin-bottom: 2px;"></div>
        <div style="height: 2px; background: #e5e7eb; border-radius: 1px; width: 70%;"></div>
      </div>
    </div>
    
    <div class="floating-element progress-bar">
      <div style="padding: 6px; display: flex; align-items: center;">
        <div style="width: 100%; height: 4px; background: #e5e7eb; border-radius: 2px; overflow: hidden;">
          <div style="width: 70%; height: 100%; background: linear-gradient(90deg, #f59e0b, #eab308); border-radius: 2px;"></div>
        </div>
      </div>
    </div>
    
    <div class="floating-element graph-element">
      <div style="padding: 8px; display: flex; align-items: end; justify-content: center; gap: 2px; height: 100%;">
        <div style="width: 3px; height: 8px; background: #3b82f6; border-radius: 1px;"></div>
        <div style="width: 3px; height: 12px; background: #22c55e; border-radius: 1px;"></div>
        <div style="width: 3px; height: 6px; background: #ef4444; border-radius: 1px;"></div>
        <div style="width: 3px; height: 10px; background: #f59e0b; border-radius: 1px;"></div>
      </div>
    </div>
    
    <img src="{{ asset('images/login3.png') }}" alt="person Image">
  </div>

  <div class="right">
    <div class="form-box">
      <h2>Sign In</h2>
      <form method="POST" action="{{ route('logincheck') }}">
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
        <button type="submit" class="btn">Sign In</button>
      </form>

      <div class="or">or continue with :</div>
      <div class="social">
        <a href="#"><i class="fa-brands fa-google"></i></a>
        <a href="#"><i class="fa-brands fa-instagram"></i></a>
        <a href="#"><i class="fa-brands fa-facebook-f"></i></a>
      </div>

      <div class="register-link">
        Belum punya akun? <a href="{{ route('register') }}">Daftar</a>
      </div>
    </div>
  </div>
</body>
</html>
