<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Create Account</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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
    }

    /* Left Side */
.left {
  flex: 1;
  background: #ECEFEC;
  display: flex;
  justify-content: center;   
  align-items: flex-end;     
  padding-bottom: 20px;      
}

.left img {
  width: 140%;          
  height: auto;
  object-fit: contain;
  transform: translateY(40px);
}


   
    /* Right Side */
    .right {
      flex: 1;
      background: #fff;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .form-box {
      width: 80%;
      max-width: 400px;
      text-align: center;
    }

    .form-box h2 {
      font-size: 24px;
      font-weight: 600;
      margin-bottom: 25px;
      color: #0b0c0cff;
    }

    .input-group {
      position: relative;
      margin-bottom: 18px;
    }

    .input-group i {
      position: absolute;
      top: 50%;
      left: 14px;
      transform: translateY(-50%);
      color: #577C8E;
    }

    .input-group input,
    .input-group select {
      width: 100%;
      padding: 12px 14px 12px 40px;
      border: 1.5px solid #cbd5e1;
      border-radius: 10px;
      font-size: 14px;
      outline: none;
      background: #fff;
    }

    .input-group input:focus,
    .input-group select:focus {
      border-color: #577C8E;
      box-shadow: 0 0 4px rgba(87,124,142,0.4);
    }

    /* select custom */
    .input-group.select-wrapper {
      position: relative;
    }
    .input-group.select-wrapper::after {
      content: "▼";
      font-size: 12px;
      color: #577C8E;
      position: absolute;
      right: 14px;
      top: 50%;
      transform: translateY(-50%);
      pointer-events: none;
    }
    .input-group select {
      -webkit-appearance: none;
      -moz-appearance: none;
      appearance: none;
    }

    /* Button */
    .btn {
      width: 100%;
      padding: 12px;
      background: #000;
      color: #fff;
      border: none;
      border-radius: 10px;
      font-size: 15px;
      cursor: pointer;
      margin-top: 10px;
      transition: 0.3s;
    }

    .btn:hover {
      background: #2F4157;
    }

    .signin {
      text-align: center;
      margin-top: 12px;
      font-size: 13px;
    }

    .signin a {
      color: #070707ff;
      font-weight: 600;
      text-decoration: none;
    }

    .signin a:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>
  <!-- Left -->
  <div class="left">
    
    <img src="{{ asset('images/person.png') }}" alt="Person">
  </div>

  <!-- Right -->
  <div class="right">
    <div class="form-box">
      <h2>Create Account</h2>
      <form action="{{ route('register.process') }}" method="POST">
        @csrf
        <div class="input-group">
          <i class="fa fa-user"></i>
          <input type="text" name="name" placeholder="Name" required>
        </div>

        <div class="input-group">
          <i class="fa fa-envelope"></i>
          <input type="email" name="email" placeholder="Email" required>
        </div>

        <div class="input-group">
          <i class="fa fa-lock"></i>
          <input type="password" name="password" placeholder="Password" required>
        </div>

        <div class="input-group">
          <i class="fa fa-phone"></i>
          <input type="text" name="phone" placeholder="Phone Number" required>
        </div>

        <div class="input-group select-wrapper">
          <i class="fa fa-users"></i>
          <select name="role" required>
            <option value="">Recrutment</option>
            <option value="jobseeker">Pelamar</option>
            
          </select>
        </div>

        <button type="submit" class="btn">Sign Up</button>
      </form>
      <p class="signin">Already have an account? <a href="{{ route('login') }}">Sign In</a></p>
    </div>
  </div>
</body>
</html>
