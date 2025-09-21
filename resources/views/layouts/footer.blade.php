<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>GetJobs - Footer</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

  <style>
    footer {
      width: 100%;
      background-color: #f8f9fa;
      padding: 60px 0 30px 0;
      position: relative;
      overflow: hidden;
    }

    footer h4 {
      color: #2f4157;
      font-weight: bold;
      margin-bottom: 20px;
      font-size: 16px;
    }

    footer p, footer a {
      color: #6c757d;
      font-size: 14px;
      text-decoration: none;
      margin: 0;
      line-height: 1.6;
    }

    footer a:hover {
      color: #007bff;
    }

    footer ul {
      padding: 0;
      margin: 0;
      list-style: none;
    }
    footer ul li {
      margin-bottom: 10px;
    }

    /* Logo di footer */
    .footer-logo {
      display: block;
      max-width: 100px;
      height: auto;
      margin-bottom: -30px;
      margin-top: -40px;
    }

    /* Deskripsi di bawah logo */
    .footer-desc {
      font-size: 14px;
      line-height: 1.6;
      margin: 0;
      max-width: 220px;
    }

    /* Floating decorations */
    .floating {
      position: absolute;
      border-radius: 50%;
      opacity: 0.6;
    }
    .float1 { top: 20px; left: 40px; width: 15px; height: 15px; background: #f78da7; }
    .float2 { top: 60px; right: 80px; width: 20px; height: 20px; background: #89c4f4; }
    .float3 { bottom: 80px; left: 25%; width: 10px; height: 10px; background: #55efc4; }
    .float4 { bottom: 100px; right: 50px; width: 18px; height: 18px; background: #a29bfe; }
    .float5 { top: 50%; left: 60px; width: 8px; height: 8px; background: #ffeaa7; }
    .float6 { top: 100px; right: 30%; width: 12px; height: 12px; background: #00cec9; }
    .float7 { bottom: 60px; left: 65%; width: 15px; height: 15px; background: #fab1a0; }

    /* Social Icons */
    .social-icons a {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      width: 32px;
      height: 32px;
      margin-right: 6px;
      border-radius: 50%;
      background: #dee2e6;
      color: #6c757d;
      transition: all 0.3s;
      font-size: 12px;
    }
    .social-icons a:hover {
      background: #007bff;
      color: #fff;
    }

    /* Testimoni */
    .testimoni-input {
      display: flex;
      align-items: center;
      background: #f1f3f5;
      border-radius: 50px;
      padding: 5px 15px;
      height: 45px;
    }

    .testimoni-input input {
      border: none;
      outline: none;
      background: transparent;
      flex: 1;
      font-size: 14px;
      color: #333;
    }

    .testimoni-input button {
      border: none;
      background: #2f4157;
      color: #fff;
      width: 40px;
      height: 40px;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      cursor: pointer;
      transition: background 0.3s;
      margin-left: 8px;
    }

    .testimoni-input button:hover {
      background: #007bff;
    }

    /* Copyright */
    .copyright {
      border-top: 1px solid #dee2e6;
      margin-top: 40px;
      padding-top: 15px;
      text-align: center;
      font-size: 13px;
      color: #6c757d;
    }

    footer .row {
      align-items: flex-start !important;
    }

    footer .testimoni-box {
      max-width: 250px;
      margin: 0 auto;
    }
  </style>
</head>
<body>

  <!-- Footer -->
  <footer>
    <!-- Floating decorations -->
    <div class="floating float1"></div>
    <div class="floating float2"></div>
    <div class="floating float3"></div>
    <div class="floating float4"></div>
    <div class="floating float5"></div>
    <div class="floating float6"></div>
    <div class="floating float7"></div>

    <div class="container">
      <div class="row d-flex justify-content-around gy-4 text-start">
        <!-- Brand Column -->
        <div class="col-md-3 d-flex flex-column h-100 justify-content-start">
          <a href="{{ url('/') }}" class="logo-box">
            <img src="{{ asset('images/logo.png') }}" alt="GetJobs Logo" class="footer-logo">
          </a>
          <p class="mt-3 footer-desc">
            Searching for a job or hiring?<br>
            Do both with ease on our smart and intuitive platform.
          </p>
          <div class="social-icons mt-3">
            <a href="#"><i class="fab fa-facebook-f"></i></a>
            <a href="#"><i class="fab fa-twitter"></i></a>
            <a href="#"><i class="fab fa-instagram"></i></a>
            <a href="#"><i class="fab fa-linkedin-in"></i></a>
          </div>
        </div>

        <!-- Kota Besar -->
        <div class="col-md-2">
          <h4>Kota Besar</h4>
          <ul>
            <li><a href="#">Bandung</a></li>
            <li><a href="#">Jakarta</a></li>
            <li><a href="#">Malang</a></li>
            <li><a href="#">Semarang</a></li>
            <li><a href="#">Surabaya</a></li>
          </ul>
        </div>

        <!-- Kategori -->
        <div class="col-md-2">
          <h4>Kategori</h4>
          <ul>
            <li><a href="#">Communication</a></li>
            <li><a href="#">Engineering</a></li>
            <li><a href="#">Business</a></li>
            <li><a href="#">Design</a></li>
            <li><a href="#">Technology</a></li>
          </ul>
        </div>

        <!-- Testimoni -->
        <div class="col-md-3">
          <h4>Kirim Testimoni</h4>
          <form class="testimoni-box w-100">
            <div class="testimoni-input">
              <input type="text" placeholder="Masukkan testimoni Anda...">
              <button type="submit">
                <i class="fas fa-arrow-right"></i>
              </button>
            </div>
          </form>
        </div>
      </div>

      <!-- Copyright -->
      <div class="copyright">
        <p>&copy; 2025 GetJobs ID. All Rights Reserved.</p>
      </div>
    </div>
  </footer>
</body>
</html>
