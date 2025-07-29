<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login - GetJobs</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@700;600;400&display=swap" rel="stylesheet">
    <style>
        body {
            margin: 0;
            font-family: 'Inter', Arial, sans-serif;
            background: #fff;
            overflow: hidden;
        }
        .login-root {
            height: 100vh;
            display: flex;
            align-items: stretch;
            overflow: hidden;
        }
        .login-left {
            flex: 1;
            padding: 0 0 0 0;
            background: #fff;
           
        }
        .login-logo {
            display: block;
            width: 100px;
            height: auto;
            margin-bottom: 44px;
            align-self: flex-start;
            margin-left: 64px;
        }
        .login-form-container {
            width: 100%;
            max-width: 340px;
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            margin: 0 auto;
            transform: translateX(30px); 
        }
        .login-title {
            font-size: 2.1rem;
            font-weight: 700;
            color: #0B254B;
            margin-bottom: 32px;
            line-height: 1.1;
        }
        .login-form {
            width: 100%;
            display: flex;
            flex-direction: column;
            gap: 18px;
        }
        .input-row {
            display: flex;
            flex-direction: column;
            gap: 0;
            margin-bottom: 12px;
        }
        .input-row input {
            width: 350px;
            font-size: 1rem;
            font-family: 'Inter', Arial, sans-serif;
            color: #223046;
            background: #fff;
            border: 1.5px solid #e0e0e0;
            border-radius: 8px;
            padding: 12px 16px;
            outline: none;
            transition: border 0.2s, box-shadow 0.2s;
            box-sizing: border-box;
        }
        .input-row input:focus {
            border-color: #8f5cff;
            box-shadow: 0 2px 8px rgba(143, 92, 255, 0.08);
        }
        .input-row input::placeholder {
            color: #b0bfc7;
            opacity: 1;
            font-weight: 500;
        }
        .forgot-link {
            margin-top: 4px;
            margin-bottom: 18px;
            color: #223046;
            font-size: 1rem;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 6px;
        }
        .reset-link {
            color: #b0bec5;
            font-size: 1rem;
            font-weight: 500;
            text-decoration: none;
            transition: color 0.2s;
        }
        .reset-link:hover {
            color: #1E88E5;
        }
        .login-btn-group {
            display: flex;
            gap: 16px;
            margin-top: 12px;
        }
        .login-btn {
            border: none;
            border-radius: 12px;
            padding: 10px 32px;
            font-size: 1rem;
            font-family: 'Inter', Arial, sans-serif;
            font-weight: 700;
            cursor: pointer;
            transition: background 0.2s, color 0.2s, box-shadow 0.2s;
            box-shadow: none;
            outline: none;
        }
        .login-btn-light {
            background: linear-gradient(90deg, #ffffff 0%, #F4EFEB 100%);
            color: #223046;
            border: 0.5px solid #bfc3c7;
            border-radius: 12px;
        }
        .login-btn-light:hover {
            background: linear-gradient(90deg, #F4EFEB 0%, #ffffff 100%);
            color: #163561;
            border-color: #bfc3c7;
        }
        .login-btn-dark {
            background: linear-gradient(90deg, #6a879c 0%, #223046 100%);
            color: #fff;
            border: none;
        }
        .login-btn-dark:hover {
            background: linear-gradient(90deg, #223046 0%, #6a879c 100%);
            color: #fff;
        }
        .login-right {
            flex:1;
            background: rgb(255, 255, 255);
            display: flex;
            align-items: center;
            justify-content: right;
            border-radius: 32px 0 0 32px;
            overflow: hidden;
            padding: 10px 10px;
        }
        .login-illustration {
            max-width: 100%;
            max-height: 100%;
            border-radius: 12px;
            object-fit: contain;
            display: block;
        }
        @media (max-width: 900px) {
            .login-root {
                flex-direction: column;
                height: 100vh;
                overflow: hidden;
            }
            .login-left, .login-right {
                flex: none;
                width: 100%;
                border-radius: 0;
                padding: 16px;
                overflow: hidden;
            }
            .login-logo {
                margin-top: 8px;
                margin-bottom: 16px;
            }
            .login-right {
                border-radius: 0;
                padding: 16px;
            }
            .login-title {
                font-size: 1.8rem;
                margin-bottom: 24px;
            }
            .input-row input {
                width: 180px;
            }
        }
    </style>
</head>
<body>
    <div class="login-root">
        <div class="login-left">
            <img src="{{ asset('images/logo-getjobs.png') }}" alt="GetJobs Logo" class="login-logo" />
            <div class="login-form-container">
                <div class="login-title">Holla,<br>Welcome back</div>
                <form class="login-form" action="/login" method="POST">
                    @csrf
                    <div class="input-row">
                        <input type="email" name="email" id="email" placeholder="Email" required>
                       
                    </div>
                    <div class="input-row">
                        <input type="password" name="password" id="password" placeholder="Password" required>
                        
                    </div>
                    <div class="forgot-link">
                        Forgot your password? <a href="#" class="reset-link">reset</a>
                    </div>
                    <div class="login-btn-group">
                        <button type="submit" class="login-btn login-btn-light">Sign In</button>
                        <button type="button" class="login-btn login-btn-dark">Sign Up</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="login-right">
            <img class="login-illustration" src="{{ asset('images/login-illustration.png') }}" alt="Login Illustration">
        </div>
    </div>
</body>
</html>
