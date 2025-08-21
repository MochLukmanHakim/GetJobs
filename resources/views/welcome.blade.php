<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GetJobs - Dapatkan Talenta Terbaik dengan Mudah</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            line-height: 1.6;
            color: #1f2937;
            background-color: #ffffff;
            overflow-x: hidden;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 24px;
        }

        /* Navigation */
        .navbar {
            background: #ffffff;
            border-bottom: 1px solid #f3f4f6;
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1000;
            padding: 16px 0;
        }

        .nav-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 24px;
        }

        .logo {
            font-size: 24px;
            font-weight: 700;
            color: #1f2937;
            text-decoration: none;
        }

        .nav-menu {
            display: flex;
            align-items: center;
            gap: 32px;
            list-style: none;
        }

        .nav-link {
            color: #6b7280;
            text-decoration: none;
            font-weight: 500;
            font-size: 14px;
            transition: all 0.2s ease;
        }

        .nav-link:hover {
            color: #1f2937;
        }

        .btn-login {
            background: #ffffff;
            border: 1px solid #d1d5db;
            padding: 8px 16px;
            border-radius: 6px;
            color: #374151;
            text-decoration: none;
            font-weight: 500;
            font-size: 14px;
            transition: all 0.2s ease;
        }

        .btn-login:hover {
            border-color: #9ca3af;
            background: #f9fafb;
        }

        /* Main Content */
        main {
            margin-top: 72px;
        }

        /* Hero Section */
        .hero {
            background: #f8fafc;
            padding: 80px 0;
        }

        .hero-container {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 80px;
            align-items: center;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 24px;
        }

        .hero-content h1 {
            font-size: 48px;
            font-weight: 700;
            color: #1f2937;
            margin-bottom: 16px;
            line-height: 1.1;
        }

        .hero-description {
            font-size: 18px;
            color: #6b7280;
            margin-bottom: 32px;
            line-height: 1.6;
        }

        .btn-primary {
            background: #1f2937;
            color: #ffffff;
            padding: 12px 24px;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            text-decoration: none;
            display: inline-block;
            transition: all 0.2s ease;
            cursor: pointer;
            font-size: 14px;
        }

        .btn-primary:hover {
            background: #374151;
        }

        /* Dashboard Mockup */
        .hero-image {
            position: relative;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .dashboard-mockup {
            width: 100%;
            max-width: 520px;
            height: 320px;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
            background: #ffffff;
            padding: 16px;
            position: relative;
            overflow: visible;
        }

        .dashboard-interface {
            position: relative;
            width: 100%;
            height: 100%;
            background: #f8fafc;
            border-radius: 8px;
            padding: 16px;
        }

        .dashboard-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 16px;
            padding-bottom: 8px;
            border-bottom: 1px solid #e5e7eb;
        }

        .dashboard-title {
            font-size: 14px;
            font-weight: 600;
            color: #1f2937;
        }

        .dashboard-controls {
            display: flex;
            gap: 6px;
        }

        .control-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: #d1d5db;
        }

        .control-dot.red { background: #ef4444; }
        .control-dot.yellow { background: #f59e0b; }
        .control-dot.green { background: #10b981; }

        .dashboard-tabs {
            display: flex;
            gap: 8px;
            margin-bottom: 16px;
        }

        .tab {
            padding: 6px 12px;
            background: #ffffff;
            border-radius: 6px;
            font-size: 12px;
            color: #6b7280;
            border: 1px solid #e5e7eb;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .tab.active {
            background: #3b82f6;
            color: white;
            border-color: #3b82f6;
        }

        .dashboard-content {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
            height: 160px;
        }

        .content-card {
            background: #ffffff;
            border-radius: 6px;
            padding: 12px;
            border: 1px solid #e5e7eb;
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .card-title {
            font-size: 12px;
            font-weight: 600;
            color: #1f2937;
        }

        .card-badge {
            background: #10b981;
            color: white;
            font-size: 10px;
            padding: 2px 6px;
            border-radius: 4px;
            font-weight: 500;
        }

        .card-stats {
            display: flex;
            gap: 12px;
            margin-top: 8px;
        }

        .stat-item {
            flex: 1;
        }

        .stat-number {
            font-size: 16px;
            font-weight: 700;
            color: #1f2937;
        }

        .stat-label {
            font-size: 10px;
            color: #6b7280;
        }

        .progress-bar {
            width: 100%;
            height: 4px;
            background: #f3f4f6;
            border-radius: 2px;
            overflow: hidden;
            margin: 6px 0;
        }

        .progress-fill {
            height: 100%;
            background: #3b82f6;
            border-radius: 2px;
            transition: width 0.3s ease;
        }

        .progress-fill.green { background: #10b981; }
        .progress-fill.orange { background: #f59e0b; }

        /* Candidates Section */
        .candidates-section {
            padding: 80px 0;
            background: #ffffff;
        }

        .section-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 80px;
            align-items: center;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 24px;
        }

        .candidates-showcase {
            position: relative;
        }

        /* Updated Candidate Gallery Layout */
        .candidate-gallery {
            position: relative;
            width: 100%;
            height: 400px;
            display: grid;
            grid-template-columns: 1fr 1fr;
            grid-template-rows: 1fr 1fr;
            gap: 16px;
            padding: 16px;
        }

        /* Candidate card base styles */
        .candidate-card {
            position: relative;
            background: #ffffff;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
            transition: all 0.2s ease;
            display: flex;
            flex-direction: column;
        }

        .candidate-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(0,0,0,0.12);
        }

        /* Top left card - with blue background */
        .candidate-card.top-left {
            background: linear-gradient(135deg, #60a5fa 0%, #3b82f6 100%);
            grid-column: 1;
            grid-row: 1;
        }

        /* Top right card - with job listings */
        .candidate-card.top-right {
            background: #f8fafc;
            grid-column: 2;
            grid-row: 1;
            padding: 16px;
        }

        /* Bottom left card - with blue background */
        .candidate-card.bottom-left {
            background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
            grid-column: 1;
            grid-row: 2;
        }

        /* Bottom right card - with pink background */
        .candidate-card.bottom-right {
            background: linear-gradient(135deg, #f472b6 0%, #ec4899 100%);
            grid-column: 2;
            grid-row: 2;
        }

        .candidate-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 16px;
        }

        /* Badge for candidate count */
        .candidate-badge {
            position: absolute;
            top: 12px;
            right: 12px;
            background: rgba(255, 255, 255, 0.95);
            color: #374151;
            border-radius: 16px;
            padding: 6px 10px;
            font-size: 12px;
            font-weight: 600;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            z-index: 5;
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .candidate-badge .search-icon {
            width: 12px;
            height: 12px;
            background: #6b7280;
            border-radius: 50%;
        }

        /* Job listings in top right */
        .job-listings {
            display: grid;
            grid-template-columns: repeat(6, 1fr);
            gap: 6px;
            margin-bottom: 16px;
        }

        .job-dot {
            width: 6px;
            height: 6px;
            background: #d1d5db;
            border-radius: 50%;
        }

        .job-dot.active {
            background: #1f2937;
        }

        /* Small avatars for bottom left */
        .small-avatars {
            position: absolute;
            bottom: 16px;
            left: 16px;
            display: flex;
            gap: -6px;
        }

        .small-avatar {
            width: 28px;
            height: 28px;
            border-radius: 50%;
            border: 2px solid rgba(255, 255, 255, 0.9);
            margin-left: -6px;
        }

        .small-avatar:first-child {
            margin-left: 0;
        }

        /* Text overlay for cards */
        .card-text {
            position: absolute;
            bottom: 16px;
            left: 16px;
            color: white;
            font-weight: 600;
            font-size: 14px;
        }



        @keyframes pulse {
            0% {
                transform: scale(0.95);
                box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.7);
            }
            
            70% {
                transform: scale(1);
                box-shadow: 0 0 0 10px rgba(16, 185, 129, 0);
            }
            
            100% {
                transform: scale(0.95);
                box-shadow: 0 0 0 0 rgba(16, 185, 129, 0);
            }
        }

        .section-content .eyebrow {
            color: #6b7280;
            font-size: 14px;
            font-weight: 500;
            margin-bottom: 8px;
        }

        .section-content h2 {
            font-size: 36px;
            font-weight: 700;
            color: #1f2937;
            margin-bottom: 16px;
            line-height: 1.2;
        }

        .section-content .subtitle {
            font-size: 18px;
            font-weight: 600;
            color: #374151;
            margin-bottom: 12px;
        }

        .section-content .description {
            color: #6b7280;
            font-size: 16px;
            margin-bottom: 24px;
            line-height: 1.6;
        }

        /* FAQ Section */
        .faq-section {
            padding: 80px 0;
            background: #f8fafc;
        }

        .section-title {
            text-align: center;
            font-size: 36px;
            font-weight: 700;
            color: #1f2937;
            margin-bottom: 48px;
        }

        .faq-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 24px;
            max-width: 1000px;
            margin: 0 auto;
            padding: 0 24px;
        }

        .faq-item {
            background: #ffffff;
            border-radius: 12px;
            padding: 24px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
            transition: all 0.2s ease;
            border: 1px solid #e5e7eb;
            cursor: pointer;
        }

        .faq-item:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        }

        .faq-question {
            font-weight: 600;
            color: #1f2937;
            margin-bottom: 8px;
            display: flex;
            align-items: flex-start;
            gap: 12px;
            font-size: 14px;
        }

        .faq-icon {
            color: #6b7280;
            font-weight: bold;
            font-size: 16px;
            line-height: 1;
            flex-shrink: 0;
            margin-top: 1px;
            transition: all 0.2s ease;
        }

        .faq-answer {
            color: #6b7280;
            line-height: 1.6;
            font-size: 14px;
            margin-left: 28px;
            max-height: 0;
            overflow: hidden;
            transition: all 0.2s ease;
            opacity: 0;
        }

        .faq-answer.show {
            max-height: 200px;
            opacity: 1;
            margin-top: 8px;
        }

        /* Testimonials Section */
        .testimonials-section {
            padding: 80px 0;
            background: #ffffff;
            text-align: center;
        }

        .testimonials-title {
            font-size: 28px;
            font-weight: 700;
            color: #1f2937;
            margin-bottom: 8px;
        }

        .testimonials-subtitle {
            font-size: 24px;
            color: #6b7280;
            font-weight: 500;
            margin-bottom: 48px;
        }

        .testimonial-avatars {
            display: flex;
            justify-content: center;
            gap: -8px;
            margin-bottom: 32px;
            flex-wrap: wrap;
        }

        .testimonial-avatar {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid #ffffff;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            margin-left: -8px;
            transition: all 0.2s ease;
        }

        .testimonial-avatar:first-child {
            margin-left: 0;
        }

        .testimonial-avatar:hover {
            transform: translateY(-2px) scale(1.05);
            box-shadow: 0 4px 12px rgba(0,0,0,0.2);
            z-index: 10;
        }

        .testimonial-content {
            max-width: 700px;
            margin: 0 auto;
        }

        .quote-mark {
            font-size: 48px;
            color: #3b82f6;
            margin-bottom: 16px;
            line-height: 1;
        }

        .testimonial-author {
            font-weight: 600;
            color: #1f2937;
            margin-bottom: 8px;
            font-size: 18px;
        }

        .testimonial-position {
            color: #6b7280;
            margin-bottom: 24px;
            font-size: 14px;
        }

        .testimonial-text {
            font-size: 18px;
            color: #6b7280;
            line-height: 1.6;
            font-style: italic;
        }

        /* Footer */
        .footer {
            background: linear-gradient(135deg, #1f2937 0%, #374151 100%);
            color: #d1d5db;
            padding: 48px 0 16px;
        }

        .footer-content {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr 1fr;
            gap: 48px;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 24px;
        }

        .footer-section h3 {
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 16px;
            color: #f3f4f6;
        }

        .footer-section p {
            color: #9ca3af;
            line-height: 1.6;
            margin-bottom: 16px;
            font-size: 14px;
        }

        .footer-section ul {
            list-style: none;
        }

        .footer-section li {
            margin-bottom: 8px;
        }

        .footer-section a {
            color: #9ca3af;
            text-decoration: none;
            transition: all 0.2s ease;
            font-size: 14px;
        }

        .footer-section a:hover {
            color: #3b82f6;
        }

        .social-icons {
            display: flex;
            gap: 12px;
            margin-top: 16px;
        }

        .social-icon {
            width: 32px;
            height: 32px;
            background: #374151;
            border-radius: 6px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #d1d5db;
            text-decoration: none;
            transition: all 0.2s ease;
            font-size: 14px;
        }

        .social-icon:hover {
            background: #3b82f6;
            transform: translateY(-1px);
        }

        .footer-bottom {
            text-align: center;
            padding-top: 32px;
            border-top: 1px solid #374151;
            margin-top: 32px;
            color: #9ca3af;
            font-size: 12px;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .nav-menu {
                display: none;
            }
            
            .hero-container,
            .section-grid {
                grid-template-columns: 1fr;
                gap: 3rem;
                text-align: center;
            }
            
            .hero-content h1 {
                font-size: 2.5rem;
            }
            
            .section-content h2 {
                font-size: 2rem;
            }
            
            .faq-grid {
                grid-template-columns: 1fr;
            }
            
            .footer-content {
                grid-template-columns: 1fr;
                text-align: center;
                gap: 2rem;
            }
            
            .candidate-gallery {
                height: 350px;
                transform: scale(0.8);
            }

            .main-candidate-card {
                width: 160px;
                height: 220px;
            }

            .small-candidate-card {
                width: 120px;
                padding: 0.75rem;
            }

            .small-candidate-card.card-top {
                left: -40px;
                transform: rotate(-5deg);
            }

            .small-candidate-card.card-bottom {
                right: -50px;
                transform: rotate(3deg);
            }

            .chat-bubble {
                right: -10px;
                max-width: 140px;
                font-size: 0.75rem;
                padding: 0.6rem 0.8rem;
            }

            .status-indicator {
                left: -30px;
                font-size: 0.75rem;
                padding: 0.4rem 0.8rem;
            }
        }

        /* Animation Classes */
        .fade-in {
            animation: fadeIn 0.6s ease-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .floating {
            animation: float 6s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar">
        <div class="nav-container">
            <a href="#" class="logo">GetJobs</a>
            <ul class="nav-menu">
                <li><a href="#" class="nav-link">Home</a></li>
                <li><a href="#" class="nav-link">About us</a></li>
                <li><a href="#" class="nav-link">FAQ</a></li>
                <li><a href="#" class="nav-link">Feedback</a></li>
                <li><a href="{{ route('login') }}" class="btn-login">login</a></li>
            </ul>
        </div>
    </nav>

    <!-- Main Content -->
    <main>
        <!-- Hero Section -->
        <section class="hero">
            <div class="hero-container">
                <div class="hero-content">
                    <h1>Dapatkan Talenta Terbaik dengan mudah</h1>
                    <p class="hero-description">
                        Pasang lowongan, kelola lamaran, dan rekrut kandidat terbaik lewat GetJobs dengan mudah
                    </p>
                    <a href="#" class="btn-primary">Unggah Kerja</a>
                </div>
                <div class="hero-image">
                    <div class="dashboard-mockup">
                        <div class="dashboard-interface">
                            <div class="dashboard-header">
                                <div class="dashboard-title">Aplikasi</div>
                                <div class="dashboard-controls">
                                    <div class="control-dot red"></div>
                                    <div class="control-dot yellow"></div>
                                    <div class="control-dot green"></div>
                                </div>
                            </div>
                            <div class="dashboard-tabs">
                                <div class="tab active">Lamaran Diterima</div>
                                <div class="tab">Interview</div>
                                <div class="tab">Hired</div>
                            </div>
                            <div class="dashboard-content">
                                <div class="content-card">
                                    <div class="card-header">
                                        <div class="card-title">Total Aplikan</div>
                                        <div class="card-badge">24</div>
                                    </div>
                                    <div class="progress-bar">
                                        <div class="progress-fill" style="width: 75%"></div>
                                    </div>
                                    <div class="card-stats">
                                        <div class="stat-item">
                                            <div class="stat-number">18</div>
                                            <div class="stat-label">Qualified</div>
                                        </div>
                                        <div class="stat-item">
                                            <div class="stat-number">6</div>
                                            <div class="stat-label">Review</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="content-card">
                                    <div class="card-header">
                                        <div class="card-title">Interview</div>
                                        <div class="card-badge">12</div>
                                    </div>
                                    <div class="progress-bar">
                                        <div class="progress-fill green" style="width: 60%"></div>
                                    </div>
                                    <div class="card-stats">
                                        <div class="stat-item">
                                            <div class="stat-number">8</div>
                                            <div class="stat-label">Scheduled</div>
                                        </div>
                                        <div class="stat-item">
                                            <div class="stat-number">4</div>
                                            <div class="stat-label">Completed</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Candidates Section -->
        <section class="candidates-section">
            <div class="section-grid">
                <div class="candidates-showcase">
                    <div class="candidate-gallery">
                        <!-- Top left card - Main candidate with blue background -->
                        <div class="candidate-card top-left">
                            <img src="https://images.pexels.com/photos/1681010/pexels-photo-1681010.jpeg?auto=compress&cs=tinysrgb&w=300&h=300&fit=crop" 
                                 alt="Sarah Chen" class="candidate-image">
                            <div class="candidate-badge">
                                <span class="search-icon"></span>
                                18+ Lowongan Terpenuhi
                            </div>
                        </div>
                        
                        <!-- Top right card - Job listings grid -->
                        <div class="candidate-card top-right">
                            <div class="job-listings">
                                <div class="job-dot active"></div>
                                <div class="job-dot"></div>
                                <div class="job-dot active"></div>
                                <div class="job-dot"></div>
                                <div class="job-dot active"></div>
                                <div class="job-dot"></div>
                                <div class="job-dot active"></div>
                                <div class="job-dot"></div>
                                <div class="job-dot active"></div>
                                <div class="job-dot"></div>
                                <div class="job-dot active"></div>
                                <div class="job-dot"></div>
                                <div class="job-dot active"></div>
                                <div class="job-dot"></div>
                                <div class="job-dot active"></div>
                                <div class="job-dot"></div>
                                <div class="job-dot active"></div>
                                <div class="job-dot"></div>
                                <div class="job-dot active"></div>
                                <div class="job-dot"></div>
                                <div class="job-dot active"></div>
                                <div class="job-dot"></div>
                                <div class="job-dot active"></div>
                                <div class="job-dot"></div>
                                <div class="job-dot active"></div>
                                <div class="job-dot"></div>
                                <div class="job-dot active"></div>
                                <div class="job-dot"></div>
                                <div class="job-dot active"></div>
                                <div class="job-dot"></div>
                                <div class="job-dot active"></div>
                                <div class="job-dot"></div>
                                <div class="job-dot active"></div>
                                <div class="job-dot"></div>
                                <div class="job-dot active"></div>
                                <div class="job-dot"></div>
                            </div>
                        </div>
                        
                        <!-- Bottom left card - Blue background with small avatars -->
                        <div class="candidate-card bottom-left">
                            <div class="card-text">18k+ Candidate</div>
                            <div class="small-avatars">
                                <img src="https://images.pexels.com/photos/2379004/pexels-photo-2379004.jpeg?auto=compress&cs=tinysrgb&w=64&h=64&fit=crop" 
                                     alt="Candidate 1" class="small-avatar">
                                <img src="https://images.pexels.com/photos/1222271/pexels-photo-1222271.jpeg?auto=compress&cs=tinysrgb&w=64&h=64&fit=crop" 
                                     alt="Candidate 2" class="small-avatar">
                                <img src="https://images.pexels.com/photos/1043471/pexels-photo-1043471.jpeg?auto=compress&cs=tinysrgb&w=64&h=64&fit=crop" 
                                     alt="Candidate 3" class="small-avatar">
                                <img src="https://images.pexels.com/photos/1484794/pexels-photo-1484794.jpeg?auto=compress&cs=tinysrgb&w=64&h=64&fit=crop" 
                                     alt="Candidate 4" class="small-avatar">
                            </div>
                        </div>
                        
                        <!-- Bottom right card - Pink background with female candidate -->
                        <div class="candidate-card bottom-right">
                            <img src="https://images.pexels.com/photos/3785079/pexels-photo-3785079.jpeg?auto=compress&cs=tinysrgb&w=300&h=300&fit=crop" 
                                 alt="Female Candidate" class="candidate-image">
                        </div>
                    </div>
                </div>
                
                <div class="section-content">
                    <div class="eyebrow">Mengapa Harus Kami?</div>
                    <h2>Kebutuhan talenta Anda, tepat di ujung jari</h2>
                    <div class="subtitle">Talenta yang Anda Butuhkan, Ada dalam Genggaman</div>
                    <p class="description">
                        Dalam 5 menit, semuanya siap. Pengaturan simpel, dengan desain halaman fleksibel akan memanjakan mata Anda.
                    </p>
                    <a href="#" class="btn-primary">Unggah Kerja</a>
                </div>
            </div>
        </section>

        <!-- FAQ Section -->
        <section class="faq-section">
            <div class="container">
                <h2 class="section-title">Frequently Ask Questions</h2>
                <div class="faq-grid">
                    <div class="faq-item" onclick="toggleFAQ(this)">
                        <h4 class="faq-question">
                            <span class="faq-icon">−</span>
                            How do I find jobs that match my skills?
                        </h4>
                        <p class="faq-answer show">
                            Use the search filters on GetJobs to refine your search by job category, location, experience level, and keywords relevant to your skills.
                        </p>
                    </div>

                    <div class="faq-item" onclick="toggleFAQ(this)">
                        <h4 class="faq-question">
                            <span class="faq-icon">+</span>
                            What is GetJobs?
                        </h4>
                        <p class="faq-answer">
                            GetJobs is a modern job platform that connects talented professionals with great opportunities. We make hiring and job searching simple and efficient.
                        </p>
                    </div>

                    <div class="faq-item" onclick="toggleFAQ(this)">
                        <h4 class="faq-question">
                            <span class="faq-icon">+</span>
                            Do I need to upload a CV to use GetJobs?
                        </h4>
                        <p class="faq-answer">
                            While not mandatory for browsing, uploading your CV significantly increases your chances of being discovered by recruiters and getting matched with relevant opportunities.
                        </p>
                    </div>

                    <div class="faq-item" onclick="toggleFAQ(this)">
                        <h4 class="faq-question">
                            <span class="faq-icon">+</span>
                            How do I create an account on GetJobs?
                        </h4>
                        <p class="faq-answer">
                            Simply click the "login" button, then select "Create Account". You can sign up using your email address or connect with your LinkedIn profile for faster setup.
                        </p>
                    </div>

                    <div class="faq-item" onclick="toggleFAQ(this)">
                        <h4 class="faq-question">
                            <span class="faq-icon">+</span>
                            How secure is my personal data on GetJobs?
                        </h4>
                        <p class="faq-answer">
                            We take data security seriously. All personal information is encrypted and stored securely. We never share your data without permission and comply with international privacy standards.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Testimonials Section -->
        <section class="testimonials-section">
            <div class="container">
                <h2 class="testimonials-title">Suara Mereka :</h2>
                <h3 class="testimonials-subtitle">Apa Kata Mereka!</h3>
                
                <div class="testimonial-avatars">
                    <img src="https://images.pexels.com/photos/2379004/pexels-photo-2379004.jpeg?auto=compress&cs=tinysrgb&w=100&h=100&fit=crop" class="testimonial-avatar">
                    <img src="https://images.pexels.com/photos/1681010/pexels-photo-1681010.jpeg?auto=compress&cs=tinysrgb&w=100&h=100&fit=crop" class="testimonial-avatar">
                    <img src="https://images.pexels.com/photos/3785079/pexels-photo-3785079.jpeg?auto=compress&cs=tinysrgb&w=100&h=100&fit=crop" class="testimonial-avatar">
                    <img src="https://images.pexels.com/photos/1222271/pexels-photo-1222271.jpeg?auto=compress&cs=tinysrgb&w=100&h=100&fit=crop" class="testimonial-avatar">
                    <img src="https://images.pexels.com/photos/1043471/pexels-photo-1043471.jpeg?auto=compress&cs=tinysrgb&w=100&h=100&fit=crop" class="testimonial-avatar">
                    <img src="https://images.pexels.com/photos/1484794/pexels-photo-1484794.jpeg?auto=compress&cs=tinysrgb&w=100&h=100&fit=crop" class="testimonial-avatar">
                    <img src="https://images.pexels.com/photos/1547971/pexels-photo-1547971.jpeg?auto=compress&cs=tinysrgb&w=100&h=100&fit=crop" class="testimonial-avatar">
                </div>

                <div class="testimonial-content">
                    <div class="quote-mark">"</div>
                    <h4 class="testimonial-author">Satoshi Nakamoto</h4>
                    <p class="testimonial-position">CEO Crypto Ink</p>
                    <p class="testimonial-text">
                        Luar biasa! Terima kasih GetJobs, berkat website ini saya akhirnya menemukan karyawan yang tepat untuk usaha saya. Prosesnya cepat, mudah, dan hasilnya benar-benar memuaskan. Sangat membantu pelaku usaha seperti saya untuk berkembang!
                    </p>
                </div>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <footer class="footer">
        <div class="footer-content">
            <div class="footer-section">
                <h3>GetJobs</h3>
                <p>Searching for a job or hiring? Do both with ease on our smart and intuitive platform.</p>
                <div class="social-icons">
                    <a href="#" class="social-icon">f</a>
                    <a href="#" class="social-icon">t</a>
                    <a href="#" class="social-icon">in</a>
                    <a href="#" class="social-icon">ig</a>
                </div>
            </div>
            
            <div class="footer-section">
                <h3>Kota Besar</h3>
                <ul>
                    <li><a href="#">Bandung</a></li>
                    <li><a href="#">Jakarta</a></li>
                    <li><a href="#">Malang</a></li>
                    <li><a href="#">Semarang</a></li>
                    <li><a href="#">Surabaya</a></li>
                </ul>
            </div>
            
            <div class="footer-section">
                <h3>Kategori</h3>
                <ul>
                    <li><a href="#">Communication</a></li>
                    <li><a href="#">Engineering</a></li>
                    <li><a href="#">Business</a></li>
                    <li><a href="#">Design</a></li>
                    <li><a href="#">Technology</a></li>
                </ul>
            </div>
            
            <div class="footer-section">
                <h3>Unggah Kerjaan</h3>
                <p>Employers! Post your job here</p>
            </div>
        </div>
        
        <div class="footer-bottom">
            <p>&copy; Copyright 2025 All Rights Reserved by GetJobs ID</p>
        </div>
    </footer>

    <script>
        // FAQ Toggle functionality
        function toggleFAQ(element) {
            const answer = element.querySelector('.faq-answer');
            const icon = element.querySelector('.faq-icon');
            
            // Close other FAQ items
            document.querySelectorAll('.faq-item').forEach(item => {
                if (item !== element) {
                    const otherAnswer = item.querySelector('.faq-answer');
                    const otherIcon = item.querySelector('.faq-icon');
                    otherAnswer.classList.remove('show');
                    otherIcon.textContent = '+';
                }
            });
            
            if (answer.classList.contains('show')) {
                answer.classList.remove('show');
                icon.textContent = '+';
            } else {
                answer.classList.add('show');
                icon.textContent = '−';
            }
        }

        // Add smooth animations on page load
        document.addEventListener('DOMContentLoaded', function() {
            // Add floating animation to main candidate card
            const mainCard = document.querySelector('.main-candidate-card');
            if (mainCard) {
                mainCard.style.animation = 'float 6s ease-in-out infinite';
            }

            // Add floating animation to small candidate cards
            const smallCards = document.querySelectorAll('.small-candidate-card');
            smallCards.forEach((card, index) => {
                card.style.animationDelay = `${index * 1}s`;
                card.style.animation = 'float 5s ease-in-out infinite';
            });

            // Add fade-in animation to sections
            const sections = document.querySelectorAll('.hero-content, .section-content, .testimonial-content');
            sections.forEach((section, index) => {
                setTimeout(() => {
                    section.classList.add('fade-in');
                }, index * 300);
            });

            // Enhanced hover effects
            const interactiveElements = document.querySelectorAll('.main-candidate-card, .small-candidate-card, .faq-item, .testimonial-avatar, .btn-primary, .btn-login');
            interactiveElements.forEach(element => {
                element.addEventListener('mouseenter', function() {
                    if (this.classList.contains('small-candidate-card')) {
                        const originalTransform = this.style.transform || '';
                        this.style.transform = originalTransform + ' scale(1.05)';
                    }
                });
                
                element.addEventListener('mouseleave', function() {
                    if (this.classList.contains('card-top')) {
                        this.style.transform = 'rotate(-8deg)';
                    } else if (this.classList.contains('card-bottom')) {
                        this.style.transform = 'rotate(5deg)';
                    }
                });
            });

            // Smooth scrolling for navigation
            const navLinks = document.querySelectorAll('.nav-link');
            navLinks.forEach(link => {
                link.addEventListener('click', function(e) {
                    e.preventDefault();
                    const href = this.getAttribute('href');
                    if (href && href.startsWith('#')) {
                        const target = document.querySelector(href);
                        if (target) {
                            target.scrollIntoView({
                                behavior: 'smooth',
                                block: 'start'
                            });
                        }
                    }
                });
            });

            // Add scroll effects
            let ticking = false;
            
            function updateScrollElements() {
                const scrollY = window.scrollY;
                
                // Parallax effect for hero
                const hero = document.querySelector('.hero');
                if (hero) {
                    hero.style.transform = `translateY(${scrollY * 0.3}px)`;
                }
                
                // Navbar scroll effect
                const navbar = document.querySelector('.navbar');
                if (scrollY > 100) {
                    navbar.style.background = 'rgba(255, 255, 255, 0.98)';
                    navbar.style.boxShadow = '0 4px 20px rgba(0,0,0,0.1)';
                } else {
                    navbar.style.background = 'rgba(255, 255, 255, 0.95)';
                    navbar.style.boxShadow = '0 2px 20px rgba(0,0,0,0.05)';
                }
                
                ticking = false;
            }

            function requestTick() {
                if (!ticking) {
                    requestAnimationFrame(updateScrollElements);
                    ticking = true;
                }
            }

            window.addEventListener('scroll', requestTick);

            // Add click effects to buttons
            const buttons = document.querySelectorAll('.btn-primary, .btn-login');
            buttons.forEach(button => {
                button.addEventListener('click', function(e) {
                    // Create ripple effect
                    const ripple = document.createElement('span');
                    const rect = this.getBoundingClientRect();
                    const size = Math.max(rect.width, rect.height);
                    const x = e.clientX - rect.left - size / 2;
                    const y = e.clientY - rect.top - size / 2;
                    
                    ripple.style.width = ripple.style.height = size + 'px';
                    ripple.style.left = x + 'px';
                    ripple.style.top = y + 'px';
                    ripple.style.position = 'absolute';
                    ripple.style.borderRadius = '50%';
                    ripple.style.background = 'rgba(255, 255, 255, 0.3)';
                    ripple.style.transform = 'scale(0)';
                    ripple.style.animation = 'ripple 0.6s ease-out';
                    ripple.style.pointerEvents = 'none';
                    
                    this.style.position = 'relative';
                    this.style.overflow = 'hidden';
                    this.appendChild(ripple);
                    
                    setTimeout(() => ripple.remove(), 600);
                });
            });

            // Add intersection observer for scroll animations
            const observerOptions = {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            };

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.style.opacity = '1';
                        entry.target.style.transform = 'translateY(0)';
                    }
                });
            }, observerOptions);

            // Observe FAQ items for staggered animation
            const faqItems = document.querySelectorAll('.faq-item');
            faqItems.forEach((item, index) => {
                item.style.opacity = '0';
                item.style.transform = 'translateY(30px)';
                item.style.transition = `all 0.6s ease ${index * 0.1}s`;
                observer.observe(item);
            });
        });

        // Add additional CSS for animations
        const style = document.createElement('style');
        style.textContent = `
            @keyframes ripple {
                to {
                    transform: scale(4);
                    opacity: 0;
                }
            }
            
            @keyframes float {
                0%, 100% {
                    transform: translateY(0px);
                }
                50% {
                    transform: translateY(-8px);
                }
            }
            
            .floating-profile {
                animation: profileFloat 5s ease-in-out infinite;
            }
            
            .floating-profile.profile-2 {
                animation-delay: -2.5s;
            }
            
            @keyframes profileFloat {
                0%, 100% { transform: translateY(0px); }
                50% { transform: translateY(-12px); }
            }
            
            .dashboard-mockup:hover {
                transform: translateY(-10px);
                box-shadow: 0 30px 60px rgba(0,0,0,0.15);
            }
            
            .testimonial-avatar:hover {
                animation: avatarBounce 0.6s ease;
            }
            
            @keyframes avatarBounce {
                0%, 100% { transform: translateY(0) scale(1); }
                50% { transform: translateY(-10px) scale(1.1); }
            }
            
            .small-candidate-card.card-top {
                animation: floatRotateTop 7s ease-in-out infinite;
            }
            
            .small-candidate-card.card-bottom {
                animation: floatRotateBottom 6s ease-in-out infinite;
                animation-delay: -2s;
            }
            
            @keyframes floatRotateTop {
                0%, 100% { 
                    transform: rotate(-8deg) translateY(0px); 
                }
                50% { 
                    transform: rotate(-6deg) translateY(-10px); 
                }
            }
            
            @keyframes floatRotateBottom {
                0%, 100% { 
                    transform: rotate(5deg) translateY(0px); 
                }
                50% { 
                    transform: rotate(7deg) translateY(-8px); 
                }
            }
        `;
        document.head.appendChild(style);
    </script>
</body>
</html>