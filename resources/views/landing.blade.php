{{-- resources/views/welcome.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GetJobs - Platform Pencarian Kerja Terbaik</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .search-container {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            animation: searchBoxFloat 3s ease-in-out infinite;
        }
        
        @keyframes searchBoxFloat {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-5px); }
        }
        
        .search-container:hover {
            animation-play-state: paused;
            transform: translateY(-8px) !important;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        }
        
        .job-card-animated {
            opacity: 0;
            transform: translateY(30px);
            animation: jobCardSlideIn 0.6s ease-out forwards;
        }
        
        @keyframes jobCardSlideIn {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .search-field-focus {
            transform: scale(1.02);
            transition: all 0.3s ease;
        }
        
        .featured-job-hover {
            transform: translateY(-8px) scale(1.02);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
        }
        
        /* Testimonials Animation Styles */
        .testimonial-container {
            perspective: 1000px;
            background: linear-gradient(135deg, rgba(59, 130, 246, 0.02) 0%, rgba(147, 51, 234, 0.02) 100%);
            border-radius: 20px;
            padding: 2rem;
            transition: all 0.6s ease-in-out;
        }
        
        .testimonial-container:hover {
            background: linear-gradient(135deg, rgba(59, 130, 246, 0.05) 0%, rgba(147, 51, 234, 0.05) 100%);
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }
        
        .testimonial-content {
            backface-visibility: hidden;
            will-change: transform, opacity;
        }
        
        .testimonial-avatar {
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .testimonial-avatar:hover {
            transform: scale(1.1) rotate(5deg);
        }
        
        .testimonial-dot {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .testimonial-dot:hover {
            transform: scale(1.2);
        }
        
        @keyframes slideInRight {
            from { 
                transform: translateX(100%); 
                opacity: 0; 
            }
            to { 
                transform: translateX(0); 
                opacity: 1; 
            }
        }
        
        @keyframes slideOutLeft {
            from { 
                transform: translateX(0); 
                opacity: 1; 
            }
            to { 
                transform: translateX(-100%); 
                opacity: 0; 
            }
        }
        
        @keyframes bounce {
            0%, 20%, 53%, 80%, 100% { 
                transform: translate3d(0,0,0); 
            }
            40%, 43% { 
                transform: translate3d(0, -30px, 0); 
            }
            70% { 
                transform: translate3d(0, -15px, 0); 
            }
            90% { 
                transform: translate3d(0, -4px, 0); 
            }
        }
        
        @keyframes pulse {
            0%, 100% { 
                transform: scale(1); 
            }
            50% { 
                transform: scale(1.1); 
            }
        }
        
        .quote-icon {
            transition: transform 0.6s ease-in-out;
        }
        
        .quote-icon.rotate {
            transform: rotate(10deg);
        }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Header -->
    <header class="bg-white shadow-sm sticky top-0 z-50">
        <nav class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <h1 class="text-2xl font-bold text-gray-900">
                            <span class="text-blue-600">Get</span>Jobs
                        </h1>
                    </div>
                    <div class="hidden md:block ml-10">
                        <div class="flex items-baseline space-x-8">
                            <a href="#" class="text-gray-900 hover:text-blue-600 font-medium">Home</a>
                            <a href="#" class="text-gray-700 hover:text-blue-600 font-medium">Find Jobs</a>
                            <a href="#" class="text-gray-700 hover:text-blue-600 font-medium">FAQ</a>
                        </div>
                    </div>
                </div>
                <div class="flex items-center space-x-4">
                    <button class="text-gray-700 hover:text-blue-600 px-4 py-2 font-medium">
                        Login
                    </button>
                    <button class="bg-blue-600 text-white px-6 py-2 rounded-full font-medium hover:bg-blue-700 transition-colors">
                        Unggah Kerja
                    </button>
                </div>
            </div>
        </nav>
    </header>

    <!-- Hero Section -->
    <section class="relative bg-gradient-to-br from-blue-50 via-purple-50 to-pink-50 pt-20 pb-32 overflow-hidden">
        <!-- Floating Avatars - Static -->
        <div class="absolute inset-0 pointer-events-none">
            <!-- Avatar 1 -->
            <div class="absolute top-20 left-16">
                <div class="w-16 h-16 rounded-full bg-gradient-to-br from-green-400 to-green-500 flex items-center justify-center text-white font-bold text-lg shadow-lg">
                    <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=100&h=100&fit=crop&crop=face" alt="Avatar" class="w-full h-full rounded-full object-cover">
                </div>
                <div class="absolute -bottom-2 -right-2 w-6 h-6 bg-green-500 rounded-full"></div>
            </div>
            
            <!-- Avatar 2 -->
            <div class="absolute top-32 right-20">
                <div class="w-20 h-20 rounded-full bg-gradient-to-br from-blue-400 to-blue-500 flex items-center justify-center text-white font-bold text-xl shadow-lg">
                    <img src="https://images.unsplash.com/photo-1494790108755-2616b612b786?w=100&h=100&fit=crop&crop=face" alt="Avatar" class="w-full h-full rounded-full object-cover">
                </div>
                <div class="absolute -bottom-2 -right-2 w-6 h-6 bg-purple-500 rounded-full"></div>
            </div>
            
            <!-- Avatar 3 -->
            <div class="absolute bottom-40 left-24">
                <div class="w-14 h-14 rounded-full bg-gradient-to-br from-pink-400 to-pink-500 flex items-center justify-center text-white font-bold shadow-lg">
                    <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?w=100&h=100&fit=crop&crop=face" alt="Avatar" class="w-full h-full rounded-full object-cover">
                </div>
                <div class="absolute -bottom-1 -right-1 w-5 h-5 bg-yellow-500 rounded-full"></div>
            </div>
            
            <!-- Avatar 4 -->
            <div class="absolute top-40 right-32">
                <div class="w-12 h-12 rounded-full bg-gradient-to-br from-indigo-400 to-indigo-500 flex items-center justify-center text-white font-bold shadow-lg">
                    <img src="https://images.unsplash.com/photo-1438761681033-6461ffad8d80?w=100&h=100&fit=crop&crop=face" alt="Avatar" class="w-full h-full rounded-full object-cover">
                </div>
                <div class="absolute -bottom-1 -right-1 w-4 h-4 bg-pink-500 rounded-full"></div>
            </div>
            
            <!-- Avatar 5 -->
            <div class="absolute bottom-52 right-16">
                <div class="w-18 h-18 rounded-full bg-gradient-to-br from-purple-400 to-purple-500 flex items-center justify-center text-white font-bold text-lg shadow-lg">
                    <img src="https://images.unsplash.com/photo-1500648767791-00dcc994a43e?w=100&h=100&fit=crop&crop=face" alt="Avatar" class="w-full h-full rounded-full object-cover">
                </div>
                <div class="absolute -bottom-2 -right-2 w-6 h-6 bg-blue-500 rounded-full"></div>
            </div>
            
            <!-- Decorative Elements -->
            <div class="absolute top-24 left-1/3 w-4 h-4 bg-green-400 rounded-full opacity-60"></div>
            <div class="absolute bottom-48 left-1/2 w-3 h-3 bg-purple-400 rounded-full opacity-60"></div>
            <div class="absolute top-48 right-1/4 w-5 h-5 bg-pink-400 rounded-full opacity-60"></div>
            <div class="absolute bottom-64 right-1/3 w-2 h-2 bg-blue-400 rounded-full opacity-60"></div>
        </div>

        <div class="relative max-w-4xl mx-auto text-center px-4 sm:px-6 lg:px-8">
            <h1 class="text-4xl md:text-6xl font-bold text-gray-900 mb-6 leading-tight">
                Menghubungkan Bakat Terbaik<br>
                <span class="text-gray-800">dengan Kesempatan Terbaik</span>
            </h1>
            <p class="text-xl text-gray-600 mb-12 max-w-2xl mx-auto">
                Cocok: In SkillMu, Dapat: in Kerja yang Worth it!
            </p>
            
            <!-- Search Box -->
            <div class="search-container max-w-2xl mx-auto p-6 rounded-2xl shadow-xl mb-8">
                <div class="flex flex-col md:flex-row gap-4">
                    <div class="flex-1">
                        <div class="relative">
                            <i class="fas fa-search absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                            <input type="text" placeholder="What are you..." class="w-full pl-12 pr-4 py-4 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-gray-700">
                        </div>
                    </div>
                    <div class="flex-1">
                        <div class="relative">
                            <i class="fas fa-map-marker-alt absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                            <select class="w-full pl-12 pr-4 py-4 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-gray-700 appearance-none cursor-pointer">
                                <option>Location</option>
                                <option>Jakarta</option>
                                <option>Bandung</option>
                                <option>Surabaya</option>
                                <option>Yogyakarta</option>
                            </select>
                        </div>
                    </div>
                    <div class="flex-1">
                        <div class="relative">
                            <i class="fas fa-briefcase absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                            <select class="w-full pl-12 pr-4 py-4 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-gray-700 appearance-none cursor-pointer">
                                <option>Categories</option>
                                <option>Technology</option>
                                <option>Design</option>
                                <option>Marketing</option>
                                <option>Sales</option>
                            </select>
                        </div>
                    </div>
                    <button class="bg-gray-800 text-white px-8 py-4 rounded-xl hover:bg-gray-700 transition-colors font-medium">
                        <i class="fas fa-search mr-2"></i>
                        Search
                    </button>
                </div>
            </div>
            
            <p class="text-gray-600">
                Cari kandidat? <a href="#" class="text-blue-600 hover:underline font-medium">Pasang Lowongan di Sini!</a>
            </p>
        </div>
    </section>

    <!-- How It Works Section -->
    <section class="py-20 bg-white">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Bagaimana akan bekerja?</h2>
            </div>
            
            <div class="grid md:grid-cols-3 gap-12">
                <!-- Step 1 -->
                <div class="text-center group">
                    <div class="relative mb-8">
                        <div class="w-20 h-20 bg-gray-800 rounded-full flex items-center justify-center mx-auto mb-6 group-hover:bg-blue-600 transition-colors">
                            <i class="fas fa-user-plus text-2xl text-white"></i>
                        </div>
                        <!-- Arrow -->
                        <div class="hidden md:block absolute top-10 -right-16 w-32 h-0.5 bg-gray-300">
                            <div class="absolute right-0 top-1/2 transform -translate-y-1/2 w-0 h-0 border-l-8 border-l-gray-300 border-t-4 border-t-transparent border-b-4 border-b-transparent"></div>
                        </div>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-4">Masukkan akun</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Masuk ke akun Anda untuk mulai mencari pekerjaan yang sesuai dengan keahlian dan minat Anda
                    </p>
                </div>
                
                <!-- Step 2 -->
                <div class="text-center group">
                    <div class="relative mb-8">
                        <div class="w-20 h-20 bg-gray-800 rounded-full flex items-center justify-center mx-auto mb-6 group-hover:bg-blue-600 transition-colors">
                            <i class="fas fa-paper-plane text-2xl text-white"></i>
                        </div>
                        <!-- Arrow -->
                        <div class="hidden md:block absolute top-10 -right-16 w-32 h-0.5 bg-gray-300">
                            <div class="absolute right-0 top-1/2 transform -translate-y-1/2 w-0 h-0 border-l-8 border-l-gray-300 border-t-4 border-t-transparent border-b-4 border-b-transparent"></div>
                        </div>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-4">Kirim lamaran</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Pilih pekerjaan yang sesuai dan kirim lamaran Anda dengan mudah melalui platform kami
                    </p>
                </div>
                
                <!-- Step 3 -->
                <div class="text-center group">
                    <div class="mb-8">
                        <div class="w-20 h-20 bg-gray-800 rounded-full flex items-center justify-center mx-auto mb-6 group-hover:bg-blue-600 transition-colors">
                            <i class="fas fa-eye text-2xl text-white"></i>
                        </div>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-4">Periksa Lamaran</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Cek status kelanjutan lamaran Anda dan dapatkan notifikasi update terbaru dari perusahaan
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Search by Categories -->
    <section class="py-20 bg-gray-900 relative overflow-hidden">
        <!-- Background with office setup -->
        <div class="absolute inset-0 bg-gradient-to-r from-gray-900/90 to-gray-800/90"></div>
        <div class="absolute inset-0 bg-black/30"></div>
        
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Title -->
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold text-white mb-8">Cari Berdasar Kategori :</h2>
                
                <!-- Category Filter Buttons -->
                <div class="flex flex-wrap justify-center gap-3 mb-12">
                    @php
                    $categoryButtons = [
                        ['name' => 'New Jobs', 'active' => true],
                        ['name' => 'Designer', 'active' => false],
                        ['name' => 'Customer Service', 'active' => false],
                        ['name' => 'Data Analysis', 'active' => false],
                        ['name' => 'Delivery Driver', 'active' => false],
                        ['name' => 'Engineering', 'active' => false],
                        ['name' => 'Marketing', 'active' => false],
                        ['name' => 'Nurse', 'active' => false],
                        ['name' => 'Medical', 'active' => false],
                        ['name' => 'Project Manager', 'active' => false],
                        ['name' => 'Sales', 'active' => false],
                        ['name' => 'Warehouse', 'active' => false],
                        ['name' => 'Welder', 'active' => false],
                        ['name' => 'IT', 'active' => false]
                    ];
                    @endphp
                    
                    @foreach($categoryButtons as $button)
                    <button class="category-filter-btn px-4 py-2 rounded-full text-sm font-medium transition-all duration-300 {{ $button['active'] ? 'bg-white text-gray-900' : 'bg-gray-700 text-white hover:bg-gray-600' }}" 
                            data-category="{{ $button['name'] }}">
                        {{ $button['name'] }}
                    </button>
                    @endforeach
                </div>
            </div>
            
            <!-- Job Cards Grid -->
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6" id="jobsGrid">
                @php
                $jobListings = [
                    [
                        'title' => 'Graphic Designer',
                        'company' => 'FATIMA Company',
                        'location' => 'Malang',
                        'duration' => '7d',
                        'logo_bg' => 'bg-purple-500',
                        'logo_text' => 'F',
                        'category' => 'Designer'
                    ],
                    [
                        'title' => 'Graphic Designer',
                        'company' => 'UI Company',
                        'location' => 'Malang',
                        'duration' => '7d',
                        'logo_bg' => 'bg-blue-500',
                        'logo_text' => 'UI',
                        'category' => 'Designer'
                    ],
                    [
                        'title' => 'Graphic Designer',
                        'company' => 'MITRA Company',
                        'location' => 'Malang',
                        'duration' => '7d',
                        'logo_bg' => 'bg-green-500',
                        'logo_text' => 'M',
                        'category' => 'Designer'
                    ],
                    [
                        'title' => 'Frontend Developer',
                        'company' => 'TECH Company',
                        'location' => 'Jakarta',
                        'duration' => '5d',
                        'logo_bg' => 'bg-orange-500',
                        'logo_text' => 'T',
                        'category' => 'IT'
                    ],
                    [
                        'title' => 'Marketing Specialist',
                        'company' => 'BRAND Company',
                        'location' => 'Bandung',
                        'duration' => '3d',
                        'logo_bg' => 'bg-pink-500',
                        'logo_text' => 'B',
                        'category' => 'Marketing'
                    ],
                    [
                        'title' => 'Customer Support',
                        'company' => 'SERVICE Company',
                        'location' => 'Surabaya',
                        'duration' => '2d',
                        'logo_bg' => 'bg-indigo-500',
                        'logo_text' => 'S',
                        'category' => 'Customer Service'
                    ]
                ];
                @endphp
                
                @foreach($jobListings as $job)
                <div class="job-card bg-white rounded-xl p-6 shadow-lg hover:shadow-xl transition-all duration-300 cursor-pointer group" 
                     data-category="{{ $job['category'] }}">
                    <!-- Header with bookmark -->
                    <div class="flex items-start justify-between mb-4">
                        <div class="flex items-center">
                            <!-- Company Logo -->
                            <div class="w-12 h-12 {{ $job['logo_bg'] }} rounded-lg flex items-center justify-center mr-3">
                                <span class="text-white font-bold text-lg">{{ $job['logo_text'] }}</span>
                            </div>
                            <div>
                                <h3 class="font-bold text-gray-900 group-hover:text-blue-600 transition-colors">{{ $job['company'] }}</h3>
                            </div>
                        </div>
                        <!-- Bookmark Icon -->
                        <button class="text-gray-400 hover:text-blue-600 transition-colors">
                            <i class="far fa-bookmark text-lg"></i>
                        </button>
                    </div>
                    
                    <!-- Job Title -->
                    <h4 class="text-xl font-bold text-gray-900 mb-4 group-hover:text-blue-600 transition-colors">
                        {{ $job['title'] }}
                    </h4>
                    
                    <!-- Job Details -->
                    <div class="flex items-center justify-between mb-6">
                        <span class="text-gray-600 font-medium">{{ $job['location'] }}</span>
                        <span class="text-gray-500 text-sm">{{ $job['duration'] }}</span>
                    </div>
                    
                    <!-- Apply Button -->
                    <button class="w-full bg-gray-100 text-gray-700 py-3 rounded-lg font-semibold hover:bg-blue-600 hover:text-white transition-all duration-300 group-hover:bg-blue-600 group-hover:text-white">
                        Easy Apply
                    </button>
                </div>
                @endforeach
            </div>
            
            <!-- Load More Button -->
            <div class="text-center mt-12">
                <button class="bg-white text-gray-900 px-8 py-3 rounded-xl font-semibold hover:bg-gray-100 transition-colors">
                    Load More Jobs
                </button>
            </div>
        </div>
    </section>

    <!-- Talent Needs Section -->
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <!-- Left: image cards (same style as requested) -->
                <div class="relative h-72 md:h-80">
                    <!-- top-left card -->
                    <div class="absolute -top-2 left-0 w-44 h-44 md:w-52 md:h-52 bg-green-100 rounded-3xl overflow-hidden shadow-lg">
                        <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=300&h=300&fit=crop&crop=face" alt="candidate" class="w-full h-full object-cover">
                        <div class="absolute top-3 left-3 bg-white/90 text-gray-900 px-3 py-1 rounded-lg text-xs font-medium flex items-center shadow">
                            <span class="mr-2">1k+ Lowongan Terpenuhi</span>
                            <i class="fas fa-search text-gray-500"></i>
                        </div>
                    </div>

                    <!-- bottom-left card -->
                    <div class="absolute bottom-0 left-8 w-40 h-40 md:w-48 md:h-48 bg-blue-100 rounded-3xl overflow-hidden shadow-lg">
                        <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?w=300&h=300&fit=crop&crop=face" alt="candidate" class="w-full h-full object-cover">
                        <div class="absolute bottom-3 left-3 bg-white text-gray-800 px-3 py-1 rounded-lg text-xs font-medium shadow flex items-center">
                            <span class="mr-2">18k+ Candidate</span>
                            <div class="flex -space-x-1">
                                <div class="w-4 h-4 rounded-full bg-blue-500 border-2 border-white"></div>
                                <div class="w-4 h-4 rounded-full bg-green-500 border-2 border-white"></div>
                                <div class="w-4 h-4 rounded-full bg-yellow-400 border-2 border-white"></div>
                                <div class="w-4 h-4 rounded-full bg-pink-500 border-2 border-white"></div>
                                <div class="w-4 h-4 rounded-full bg-purple-500 border-2 border-white"></div>
                            </div>
                        </div>
                    </div>

                    <!-- right big card -->
                    <div class="absolute top-6 right-0 w-56 h-56 md:w-64 md:h-64 bg-pink-100 rounded-3xl overflow-hidden shadow-lg">
                        <img src="https://images.unsplash.com/photo-1494790108755-2616b612b786?w=350&h=350&fit=crop&crop=face" alt="candidate" class="w-full h-full object-cover">
                    </div>
                </div>

                <!-- Right: copy -->
                <div class="lg:pl-12">
                    <div class="text-sm text-blue-600 font-semibold mb-4">Mengapa Harus Kami?</div>
                    <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-6 leading-tight">
                        Kebutuhan talenta Anda, tepat di ujung jari
                    </h2>
                    <p class="text-xl text-gray-700 mb-4">Talenta yang Anda Butuhkan, Ada dalam Genggaman</p>
                    <p class="text-gray-600 mb-8 max-w-xl">Dalam 5 menit, semuanya siap. Pengaturan simpel, dengan desain halaman fleksibel akan memanjakan mata Anda.</p>
                    <button class="bg-gray-900 text-white px-8 py-4 rounded-xl font-semibold hover:bg-gray-800 transition-colors">Unggah Kerja</button>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="py-20 bg-gray-50">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-gray-900 mb-12">Apa Kata Mereka</h2>
                
                <!-- Profile Images Row -->
                <div class="flex justify-center items-center space-x-4 mb-12">
                    @php
                    $testimonialProfiles = [
                        'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=100&h=100&fit=crop&crop=face',
                        'https://images.unsplash.com/photo-1494790108755-2616b612b786?w=100&h=100&fit=crop&crop=face',
                        'https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?w=100&h=100&fit=crop&crop=face',
                        'https://images.unsplash.com/photo-1438761681033-6461ffad8d80?w=100&h=100&fit=crop&crop=face',
                        'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?w=100&h=100&fit=crop&crop=face',
                        'https://images.unsplash.com/photo-1519345182560-3f2917c472ef?w=100&h=100&fit=crop&crop=face',
                        'https://images.unsplash.com/photo-1506794778202-cad84cf45f1d?w=100&h=100&fit=crop&crop=face'
                    ];
                    @endphp
                    
                    @foreach($testimonialProfiles as $index => $profile)
                    <div class="testimonial-avatar {{ $index === 3 ? 'w-20 h-20' : 'w-16 h-16' }} rounded-full overflow-hidden {{ $index === 3 ? 'ring-4 ring-blue-500' : '' }} cursor-pointer hover:scale-110 transition-transform"
                         data-testimonial="{{ $index }}">
                        <img src="{{ $profile }}" alt="Testimonial {{ $index + 1 }}" class="w-full h-full object-cover">
                    </div>
                    @endforeach
                </div>
                
                <!-- Quote Icon -->
                <div class="text-6xl text-gray-300 mb-8 quote-icon">
                    <i class="fas fa-quote-right"></i>
                </div>
                
                <!-- Active Testimonial -->
                <div class="testimonial-container relative overflow-hidden max-w-4xl mx-auto">
                    <div class="testimonial-content transition-all duration-700 ease-in-out transform">
                        <h3 class="text-2xl font-bold text-gray-900 mb-4">Satoshi Nakamoto</h3>
                        <p class="text-gray-600 font-medium mb-6">CEO Crypto Itu</p>
                        <p class="text-xl text-gray-700 leading-relaxed italic">
                            "Luar biasa! Terima kasih Get Jobs, saya mendapat pekerjaan menurut keterangan yang tepat untuk usaha saya. Prosesnya cepat, mudah, dan hasilnya benar-benar memuaskan. Sangat membantu pelaku usaha seperti saya untuk berkembang!"
                        </p>
                    </div>
                </div>
                
                <!-- Navigation Dots -->
                <div class="flex justify-center space-x-2 mt-12">
                    @for($i = 0; $i < 7; $i++)
                    <button class="testimonial-dot w-3 h-3 rounded-full {{ $i === 3 ? 'bg-blue-500' : 'bg-gray-300' }} transition-colors" 
                            data-testimonial="{{ $i }}"></button>
                    @endfor
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Jobs -->
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center mb-12">
                <div>
                    <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Pekerjaan Terbaru</h2>
                    <p class="text-gray-600">Dapatkan kesempatan terbaik dari perusahaan ternama</p>
                </div>
                <button class="hidden md:block bg-blue-600 text-white px-6 py-3 rounded-xl hover:bg-blue-700 transition-colors">
                    Lihat Semua Jobs
                </button>
            </div>
            
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                @php
                $jobs = [
                    ['title' => 'Senior Frontend Developer', 'company' => 'TechCorp Indonesia', 'location' => 'Jakarta', 'salary' => 'Rp 15-25 juta', 'type' => 'Full-time', 'logo' => 'https://via.placeholder.com/60x60/3B82F6/FFFFFF?text=TC'],
                    ['title' => 'UI/UX Designer', 'company' => 'Creative Studio', 'location' => 'Bandung', 'salary' => 'Rp 8-15 juta', 'type' => 'Full-time', 'logo' => 'https://via.placeholder.com/60x60/8B5CF6/FFFFFF?text=CS'],
                    ['title' => 'Digital Marketing Manager', 'company' => 'StartupXYZ', 'location' => 'Surabaya', 'salary' => 'Rp 10-18 juta', 'type' => 'Full-time', 'logo' => 'https://via.placeholder.com/60x60/10B981/FFFFFF?text=SX'],
                    ['title' => 'Backend Developer', 'company' => 'InnovateLab', 'location' => 'Yogyakarta', 'salary' => 'Rp 12-20 juta', 'type' => 'Remote', 'logo' => 'https://via.placeholder.com/60x60/F59E0B/FFFFFF?text=IL'],
                    ['title' => 'Product Manager', 'company' => 'BigTech Co', 'location' => 'Jakarta', 'salary' => 'Rp 20-35 juta', 'type' => 'Hybrid', 'logo' => 'https://via.placeholder.com/60x60/EF4444/FFFFFF?text=BT'],
                    ['title' => 'Data Scientist', 'company' => 'DataCorp', 'location' => 'Jakarta', 'salary' => 'Rp 18-30 juta', 'type' => 'Full-time', 'logo' => 'https://via.placeholder.com/60x60/6366F1/FFFFFF?text=DC']
                ];
                @endphp
                
                @foreach($jobs as $job)
                <div class="bg-white border border-gray-200 p-6 rounded-xl hover:shadow-lg transition-shadow cursor-pointer group">
                    <div class="flex items-start justify-between mb-4">
                        <img src="{{ $job['logo'] }}" alt="{{ $job['company'] }}" class="w-12 h-12 rounded-lg">
                        <span class="text-xs bg-green-100 text-green-800 px-2 py-1 rounded-full font-medium">{{ $job['type'] }}</span>
                    </div>
                    <h3 class="font-bold text-gray-900 mb-2 group-hover:text-blue-600">{{ $job['title'] }}</h3>
                    <p class="text-gray-600 font-medium mb-3">{{ $job['company'] }}</p>
                    <div class="flex items-center text-sm text-gray-500 mb-4">
                        <i class="fas fa-map-marker-alt mr-2"></i>
                        <span class="mr-4">{{ $job['location'] }}</span>
                        <i class="fas fa-money-bill-wave mr-2"></i>
                        <span>{{ $job['salary'] }}</span>
                    </div>
                    <button class="w-full bg-gray-100 text-gray-800 py-3 rounded-lg font-medium hover:bg-blue-600 hover:text-white transition-colors">
                        Lamar Sekarang
                    </button>
                </div>
                @endforeach
            </div>
            
            <div class="text-center mt-12 md:hidden">
                <button class="bg-blue-600 text-white px-8 py-3 rounded-xl hover:bg-blue-700 transition-colors">
                    Lihat Semua Jobs
                </button>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-20 bg-gradient-to-r from-blue-600 to-purple-600">
        <div class="max-w-4xl mx-auto text-center px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl md:text-4xl font-bold text-white mb-6">
                Siap untuk memulai karir impian Anda?
            </h2>
            <p class="text-xl text-blue-100 mb-8 max-w-2xl mx-auto">
                Bergabunglah dengan ribuan profesional yang telah menemukan pekerjaan impian mereka di platform kami
            </p>
            <div class="flex flex-col sm:flex-row justify-center space-y-4 sm:space-y-0 sm:space-x-4">
                <button class="bg-white text-blue-600 px-8 py-4 rounded-xl text-lg font-medium hover:bg-gray-100 transform hover:scale-105 transition-all">
                    Daftar Sekarang
                </button>
                <button class="border-2 border-white text-white px-8 py-4 rounded-xl text-lg font-medium hover:bg-white hover:text-blue-600 transition-all">
                    Cari Pekerjaan
                </button>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-100 py-16 relative overflow-hidden">
        <!-- Decorative floating elements -->
        <div class="absolute inset-0 pointer-events-none">
            <div class="absolute top-8 left-16 w-4 h-4 bg-pink-300 rounded-full opacity-60"></div>
            <div class="absolute top-20 right-24 w-6 h-6 bg-blue-300 rounded-full opacity-50"></div>
            <div class="absolute bottom-16 left-1/4 w-3 h-3 bg-green-300 rounded-full opacity-70"></div>
            <div class="absolute bottom-24 right-16 w-5 h-5 bg-purple-300 rounded-full opacity-60"></div>
            <div class="absolute top-1/2 left-12 w-2 h-2 bg-yellow-300 rounded-full opacity-50"></div>
            <div class="absolute top-16 right-1/3 w-3 h-3 bg-teal-300 rounded-full opacity-60"></div>
            <div class="absolute bottom-12 left-2/3 w-4 h-4 bg-orange-300 rounded-full opacity-50"></div>
        </div>
        
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-4 gap-8">
                <!-- Brand Column -->
                <div>
                    <h3 class="text-3xl font-bold text-gray-900 mb-6">
                        <span class="text-blue-600">Get</span>Jobs
                    </h3>
                    <p class="text-gray-600 mb-6 leading-relaxed max-w-sm">
                        Searching for a job or hiring? Do both with ease on our smart and intuitive platform.
                    </p>
                    <div class="flex space-x-4">
                        <a href="#" class="w-10 h-10 bg-gray-300 rounded-full flex items-center justify-center text-gray-600 hover:bg-blue-600 hover:text-white transition-colors">
                            <i class="fab fa-facebook text-sm"></i>
                        </a>
                        <a href="#" class="w-10 h-10 bg-gray-300 rounded-full flex items-center justify-center text-gray-600 hover:bg-blue-600 hover:text-white transition-colors">
                            <i class="fab fa-twitter text-sm"></i>
                        </a>
                        <a href="#" class="w-10 h-10 bg-gray-300 rounded-full flex items-center justify-center text-gray-600 hover:bg-blue-600 hover:text-white transition-colors">
                            <i class="fab fa-instagram text-sm"></i>
                        </a>
                        <a href="#" class="w-10 h-10 bg-gray-300 rounded-full flex items-center justify-center text-gray-600 hover:bg-blue-600 hover:text-white transition-colors">
                            <i class="fab fa-linkedin text-sm"></i>
                        </a>
                    </div>
                </div>
                
                <!-- Kota Besar Column -->
                <div>
                    <h4 class="text-lg font-bold text-gray-900 mb-6">Kota Besar</h4>
                    <ul class="space-y-3">
                        <li><a href="#" class="text-gray-600 hover:text-blue-600 transition-colors">Bandung</a></li>
                        <li><a href="#" class="text-gray-600 hover:text-blue-600 transition-colors">Jakarta</a></li>
                        <li><a href="#" class="text-gray-600 hover:text-blue-600 transition-colors">Malang</a></li>
                        <li><a href="#" class="text-gray-600 hover:text-blue-600 transition-colors">Semarang</a></li>
                        <li><a href="#" class="text-gray-600 hover:text-blue-600 transition-colors">Surabaya</a></li>
                    </ul>
                </div>
                
                <!-- Kategori Column -->
                <div>
                    <h4 class="text-lg font-bold text-gray-900 mb-6">Kategori</h4>
                    <ul class="space-y-3">
                        <li><a href="#" class="text-gray-600 hover:text-blue-600 transition-colors">Communication</a></li>
                        <li><a href="#" class="text-gray-600 hover:text-blue-600 transition-colors">Engineering</a></li>
                        <li><a href="#" class="text-gray-600 hover:text-blue-600 transition-colors">Business</a></li>
                        <li><a href="#" class="text-gray-600 hover:text-blue-600 transition-colors">Design</a></li>
                        <li><a href="#" class="text-gray-600 hover:text-blue-600 transition-colors">Technology</a></li>
                    </ul>
                </div>
                
                <!-- Unggah Kerjaan Column -->
                <div>
                    <h4 class="text-lg font-bold text-gray-900 mb-6">Unggah Kerjaan</h4>
                    <div class="mb-4">
                        <p class="text-gray-600 text-sm mb-4">Employers? Post your job here</p>
                        <div class="flex items-center">
                            <input type="email" placeholder="masukkan email" 
                                   class="flex-1 px-4 py-2 border border-gray-300 rounded-l-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm">
                            <button class="bg-blue-600 text-white px-4 py-2 rounded-r-lg hover:bg-blue-700 transition-colors">
                                <i class="fas fa-arrow-right"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Copyright -->
            <div class="border-t border-gray-300 mt-12 pt-8 text-center">
                <p class="text-gray-500 text-sm">&copy; Copyright 2025 All Rights Reserved by GetJobs ID</p>
            </div>
        </div>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            console.log('DOM loaded, initializing testimonials...');
            
            // Enhanced smooth scrolling
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function (e) {
                    e.preventDefault();
                    const target = document.querySelector(this.getAttribute('href'));
                    if (target) {
                        target.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                    }
                });
            });

            // Navbar scroll effect
            let lastScrollTop = 0;
            const header = document.querySelector('header');
            
            window.addEventListener('scroll', function() {
                let scrollTop = window.pageYOffset || document.documentElement.scrollTop;
                
                if (scrollTop > lastScrollTop && scrollTop > 100) {
                    header.style.transform = 'translateY(-100%)';
                } else {
                    header.style.transform = 'translateY(0)';
                }
                
                if (scrollTop > 100) {
                    header.classList.add('shadow-lg');
                } else {
                    header.classList.remove('shadow-lg');
                }
                
                lastScrollTop = scrollTop;
            });

            // Enhanced search box animations
            const searchContainer = document.querySelector('.search-container');
            const searchInputs = document.querySelectorAll('.search-container input, .search-container select');
            
            searchInputs.forEach(input => {
                input.addEventListener('focus', function() {
                    this.classList.add('search-field-focus');
                    this.style.borderColor = '#3B82F6';
                    this.style.boxShadow = '0 0 0 3px rgba(59, 130, 246, 0.1)';
                    searchContainer.style.animationPlayState = 'paused';
                });
                
                input.addEventListener('blur', function() {
                    this.classList.remove('search-field-focus');
                    this.style.borderColor = '#E5E7EB';
                    this.style.boxShadow = 'none';
                    searchContainer.style.animationPlayState = 'running';
                });
                
                // Typing animation effect
                input.addEventListener('input', function() {
                    this.style.transform = 'scale(1.01)';
                    setTimeout(() => {
                        this.style.transform = 'scale(1)';
                    }, 150);
                });
            });

            // Featured jobs animation on scroll
            const featuredJobsSection = document.querySelector('#featuredJobs');
            const featuredJobCards = document.querySelectorAll('#featuredJobs .bg-white.border');
            
            const featuredJobsObserver = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const cards = entry.target.querySelectorAll('.bg-white.border');
                        cards.forEach((card, index) => {
                            setTimeout(() => {
                                card.classList.add('job-card-animated');
                                card.style.animationDelay = `${index * 0.1}s`;
                            }, index * 100);
                        });
                    }
                });
            }, { threshold: 0.2 });

            if (featuredJobsSection) {
                featuredJobsObserver.observe(featuredJobsSection);
            }

            // Enhanced featured job card interactions
            featuredJobCards.forEach(jobCard => {
                const applyButton = jobCard.querySelector('button');
                
                jobCard.addEventListener('mouseenter', function() {
                    this.classList.add('featured-job-hover');
                });
                
                jobCard.addEventListener('mouseleave', function() {
                    this.classList.remove('featured-job-hover');
                });
                
                // Stagger animation for job cards
                const observer = new IntersectionObserver((entries) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            entry.target.style.opacity = '1';
                            entry.target.style.transform = 'translateY(0)';
                        }
                    });
                });
                
                // Initialize with hidden state
                jobCard.style.opacity = '0';
                jobCard.style.transform = 'translateY(30px)';
                jobCard.style.transition = 'all 0.6s ease';
                
                observer.observe(jobCard);
            });

            // Search button enhanced animation
            const searchButton = document.querySelector('.search-container button');
            
            if (searchButton) {
            searchButton.addEventListener('click', function() {
                const searchTerm = document.querySelector('input[placeholder*="What are you"]').value;
                const location = document.querySelector('select').value;
                const category = document.querySelectorAll('select')[1].value;
                
                // Enhanced search animation
                if (searchTerm.trim() !== '' || location !== 'Location' || category !== 'Categories') {
                    // Animate search container
                    searchContainer.style.transform = 'scale(0.98)';
                    
                    const originalHTML = this.innerHTML;
                    this.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Searching...';
                    this.disabled = true;
                    this.style.transform = 'scale(0.95)';
                    
                    setTimeout(() => {
                        this.style.transform = 'scale(1)';
                        searchContainer.style.transform = 'scale(1)';
                    }, 200);
                    
                    setTimeout(() => {
                        this.innerHTML = originalHTML;
                        this.disabled = false;
                        showNotification(`Found jobs for: ${searchTerm || 'All positions'} in ${location || 'All locations'}`, 'success');
                    }, 1500);
                } else {
                    // Shake animation for empty search
                    searchContainer.style.animation = 'shake 0.5s ease-in-out';
                    setTimeout(() => {
                        searchContainer.style.animation = 'searchBoxFloat 3s ease-in-out infinite';
                    }, 500);
                }
            });
            }

            // Add shake animation to CSS
            const style = document.createElement('style');
            style.textContent = `
                @keyframes shake {
                    0%, 100% { transform: translateX(0); }
                    25% { transform: translateX(-5px); }
                    75% { transform: translateX(5px); }
                }
            `;
            document.head.appendChild(style);

            // Testimonials functionality
            const testimonialAvatars = document.querySelectorAll('.testimonial-avatar');
            const testimonialDots = document.querySelectorAll('.testimonial-dot');
            const testimonialContent = document.querySelector('.testimonial-content');
            const testimonialContainer = document.querySelector('.testimonial-container');
            
            // Debug logging
            console.log('Testimonial elements found:', {
                avatars: testimonialAvatars.length,
                dots: testimonialDots.length,
                content: testimonialContent ? 'Found' : 'Not found',
                container: testimonialContainer ? 'Found' : 'Not found'
            });

            const testimonials = [
                {
                    name: "Alex Johnson",
                    position: "Frontend Developer",
                    company: "TechCorp",
                    quote: "Platform ini sangat membantu saya menemukan pekerjaan impian. Proses apply yang mudah dan respons yang cepat dari perusahaan membuat pengalaman mencari kerja menjadi menyenangkan."
                },
                {
                    name: "Maria Garcia",
                    position: "UI/UX Designer", 
                    company: "Creative Studio",
                    quote: "GetJobs memberikan akses ke perusahaan-perusahaan terbaik. Interface yang user-friendly dan fitur-fitur lengkap membuat saya bisa fokus pada hal yang penting: menemukan pekerjaan yang tepat."
                },
                {
                    name: "David Chen",
                    position: "Data Scientist",
                    company: "DataCorp",
                    quote: "Sangat terkesan dengan kualitas lowongan yang tersedia di platform ini. Filter pencarian yang detail membantu saya menemukan posisi yang sesuai dengan keahlian dan minat saya."
                },
                {
                    name: "Satoshi Nakamoto",
                    position: "CEO Crypto Itu",
                    company: "Blockchain Inc",
                    quote: "Luar biasa! Terima kasih Get Jobs, saya mendapat pekerjaan menurut keterangan yang tepat untuk usaha saya. Prosesnya cepat, mudah, dan hasilnya benar-benar memuaskan. Sangat membantu pelaku usaha seperti saya untuk berkembang!"
                },
                {
                    name: "Sarah Wilson",
                    position: "Product Manager",
                    company: "StartupXYZ",
                    quote: "Platform terpercaya untuk mencari talenta berkualitas. Sistem matching yang akurat dan database kandidat yang luas membuat proses rekrutmen menjadi lebih efisien."
                },
                {
                    name: "Michael Brown",
                    position: "Marketing Director",
                    company: "BrandCo",
                    quote: "GetJobs tidak hanya membantu menemukan pekerjaan, tapi juga memberikan insight berharga tentang tren industri. Sangat recommend untuk profesional di segala level."
                },
                {
                    name: "Linda Zhang",
                    position: "HR Manager",
                    company: "People First",
                    quote: "Sebagai HR, saya sangat terbantu dengan fitur-fitur yang disediakan GetJobs. Proses screening kandidat menjadi lebih mudah dan efektif. Platform yang luar biasa!"
                }
            ];

            function updateTestimonial(index) {
                console.log('Updating testimonial to index:', index);
                
                if (!testimonialContent) {
                    console.error('Testimonial content element not found!');
                    return;
                }
                
                const testimonial = testimonials[index];
                const quoteIcon = document.querySelector('.quote-icon');
                
                if (!testimonial) {
                    console.error('Testimonial data not found for index:', index);
                    return;
                }
                
                console.log('Updating to testimonial:', testimonial.name);
                
                // Add slide out animation
                testimonialContent.style.animation = 'slideOutLeft 0.4s ease-in-out forwards';
                
                // Add rotation to quote icon
                if (quoteIcon) {
                    quoteIcon.classList.add('rotate');
                }
                
                setTimeout(() => {
                    // Update content
                    testimonialContent.innerHTML = `
                        <h3 class="text-2xl font-bold text-gray-900 mb-4">${testimonial.name}</h3>
                        <p class="text-gray-600 font-medium mb-6">${testimonial.position} - ${testimonial.company}</p>
                        <p class="text-xl text-gray-700 leading-relaxed italic">
                            "${testimonial.quote}"
                        </p>
                    `;
                    
                    console.log('Content updated for:', testimonial.name);
                    
                    // Add slide in animation
                    testimonialContent.style.animation = 'slideInRight 0.4s ease-in-out forwards';
                    
                    // Reset quote icon rotation
                    if (quoteIcon) {
                        quoteIcon.classList.remove('rotate');
                    }
                    
                    // Reset animation after completion
                    setTimeout(() => {
                        testimonialContent.style.animation = '';
                        testimonialContent.style.transform = 'translateX(0)';
                        testimonialContent.style.opacity = '1';
                    }, 400);
                }, 400);
                
                // Update active states with enhanced animations
                testimonialAvatars.forEach((avatar, i) => {
                    if (i === index) {
                        avatar.classList.add('ring-4', 'ring-blue-500', 'w-20', 'h-20');
                        avatar.classList.remove('w-16', 'h-16');
                        // Add bounce effect to active avatar
                        avatar.style.animation = 'bounce 0.6s ease-in-out';
                        setTimeout(() => {
                            avatar.style.animation = '';
                        }, 600);
                    } else {
                        avatar.classList.remove('ring-4', 'ring-blue-500', 'w-20', 'h-20');
                        avatar.classList.add('w-16', 'h-16');
                    }
                });
                
                testimonialDots.forEach((dot, i) => {
                    if (i === index) {
                        dot.classList.add('bg-blue-500');
                        dot.classList.remove('bg-gray-300');
                        // Add pulse effect to active dot
                        dot.style.animation = 'pulse 0.6s ease-in-out';
                        setTimeout(() => {
                            dot.style.animation = '';
                        }, 600);
                    } else {
                        dot.classList.remove('bg-blue-500');
                        dot.classList.add('bg-gray-300');
                    }
                });
            }

            // Add click handlers for avatars
            testimonialAvatars.forEach((avatar, index) => {
                console.log('Adding click handler to avatar', index);
                avatar.addEventListener('click', (e) => {
                    e.preventDefault();
                    console.log('Avatar clicked:', index);
                    updateTestimonial(index);
                });
            });

            // Add click handlers for dots
            testimonialDots.forEach((dot, index) => {
                console.log('Adding click handler to dot', index);
                dot.addEventListener('click', (e) => {
                    e.preventDefault();
                    console.log('Dot clicked:', index);
                    updateTestimonial(index);
                });
            });

            // Auto-rotate testimonials
            let currentTestimonialIndex = 3;
            setInterval(() => {
                currentTestimonialIndex = (currentTestimonialIndex + 1) % testimonials.length;
                updateTestimonial(currentTestimonialIndex);
            }, 8000);

            // Add ID to Featured Jobs section for targeting
            document.querySelector('section .grid.md\\:grid-cols-2.lg\\:grid-cols-3').closest('section').id = 'featuredJobs';

            // Category filter functionality
            const categoryFilterButtons = document.querySelectorAll('.category-filter-btn');
            const jobCards = document.querySelectorAll('.job-card');

            categoryFilterButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const selectedCategory = this.getAttribute('data-category');
                    
                    // Update active button
                    categoryFilterButtons.forEach(btn => {
                        btn.classList.remove('bg-white', 'text-gray-900');
                        btn.classList.add('bg-gray-700', 'text-white', 'hover:bg-gray-600');
                    });
                    
                    this.classList.remove('bg-gray-700', 'text-white', 'hover:bg-gray-600');
                    this.classList.add('bg-white', 'text-gray-900');
                    
                    // Filter job cards with animation
                    jobCards.forEach(card => {
                        const cardCategory = card.getAttribute('data-category');
                        
                        if (selectedCategory === 'New Jobs' || cardCategory === selectedCategory) {
                            card.style.opacity = '0';
                            card.style.transform = 'scale(0.9)';
                            
                            setTimeout(() => {
                                card.style.display = 'block';
                                card.style.opacity = '1';
                                card.style.transform = 'scale(1)';
                            }, 150);
                        } else {
                            card.style.opacity = '0';
                            card.style.transform = 'scale(0.9)';
                            
                            setTimeout(() => {
                                card.style.display = 'none';
                            }, 300);
                        }
                    });
                });
            });

            // Job card bookmark functionality
            document.querySelectorAll('.job-card .far.fa-bookmark').forEach(bookmark => {
                bookmark.addEventListener('click', function(e) {
                    e.stopPropagation();
                    
                    if (this.classList.contains('far')) {
                        this.classList.remove('far');
                        this.classList.add('fas', 'text-blue-600');
                    } else {
                        this.classList.remove('fas', 'text-blue-600');
                        this.classList.add('far');
                    }
                });
            });

            // Enhanced job card interactions
            document.querySelectorAll('.job-card').forEach(jobCard => {
                const applyButton = jobCard.querySelector('button');
                
                jobCard.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-8px)';
                });
                
                jobCard.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(0)';
                });
                
                // Easy Apply button functionality
                applyButton.addEventListener('click', function(e) {
                    e.stopPropagation();
                    const jobTitle = jobCard.querySelector('h4').textContent;
                    const company = jobCard.querySelector('h3').textContent;
                    
                    // Simulate apply process
                    const originalText = this.textContent;
                    this.textContent = 'Applying...';
                    this.disabled = true;
                    this.classList.remove('hover:bg-blue-600', 'hover:text-white');
                    this.classList.add('bg-blue-600', 'text-white');
                    
                    setTimeout(() => {
                        this.textContent = 'Applied ✓';
                        this.classList.remove('bg-blue-600');
                        this.classList.add('bg-green-600', 'text-white');
                        
                        // Show success message
                        showNotification(`Successfully applied to ${jobTitle} at ${company}!`, 'success');
                        
                        setTimeout(() => {
                            this.textContent = originalText;
                            this.classList.remove('bg-green-600', 'text-white');
                            this.classList.add('bg-gray-100', 'text-gray-700', 'hover:bg-blue-600', 'hover:text-white');
                            this.disabled = false;
                        }, 3000);
                    }, 1500);
                });
            });

            // Notification system
            function showNotification(message, type = 'info') {
                const notification = document.createElement('div');
                notification.className = `fixed top-4 right-4 p-4 rounded-lg shadow-lg z-50 transform translate-x-full transition-transform duration-300 ${
                    type === 'success' ? 'bg-green-600 text-white' : 
                    type === 'error' ? 'bg-red-600 text-white' : 
                    'bg-blue-600 text-white'
                }`;
                notification.innerHTML = `
                    <div class="flex items-center">
                        <i class="fas ${type === 'success' ? 'fa-check-circle' : type === 'error' ? 'fa-times-circle' : 'fa-info-circle'} mr-2"></i>
                        <span>${message}</span>
                    </div>
                `;
                
                document.body.appendChild(notification);
                
                setTimeout(() => {
                    notification.style.transform = 'translateX(0)';
                }, 100);
                
                setTimeout(() => {
                    notification.style.transform = 'translateX(full)';
                    setTimeout(() => {
                        document.body.removeChild(notification);
                    }, 300);
                }, 4000);
            }

            // Load More functionality
            document.querySelector('button:contains("Load More Jobs")') && document.querySelector('button:contains("Load More Jobs")').addEventListener('click', function() {
                const jobsGrid = document.getElementById('jobsGrid');
                const originalText = this.textContent;
                
                this.textContent = 'Loading...';
                this.disabled = true;
                
                // Simulate loading more jobs
                setTimeout(() => {
                    const additionalJobs = [
                        {
                            title: 'Backend Developer',
                            company: 'CODE Company',
                            location: 'Yogyakarta',
                            duration: '4d',
                            logo_bg: 'bg-red-500',
                            logo_text: 'C',
                            category: 'IT'
                        },
                        {
                            title: 'Project Manager',
                            company: 'MANAGE Company',
                            location: 'Bali',
                            duration: '1d',
                            logo_bg: 'bg-yellow-500',
                            logo_text: 'M',
                            category: 'Project Manager'
                        }
                    ];
                    
                    additionalJobs.forEach(job => {
                        const jobCard = document.createElement('div');
                        jobCard.className = 'job-card bg-white rounded-xl p-6 shadow-lg hover:shadow-xl transition-all duration-300 cursor-pointer group opacity-0';
                        jobCard.setAttribute('data-category', job.category);
                        jobCard.style.transform = 'translateY(20px)';
                        
                        jobCard.innerHTML = `
                            <div class="flex items-start justify-between mb-4">
                                <div class="flex items-center">
                                    <div class="w-12 h-12 ${job.logo_bg} rounded-lg flex items-center justify-center mr-3">
                                        <span class="text-white font-bold text-lg">${job.logo_text}</span>
                                    </div>
                                    <div>
                                        <h3 class="font-bold text-gray-900 group-hover:text-blue-600 transition-colors">${job.company}</h3>
                                    </div>
                                </div>
                                <button class="text-gray-400 hover:text-blue-600 transition-colors">
                                    <i class="far fa-bookmark text-lg"></i>
                                </button>
                            </div>
                            <h4 class="text-xl font-bold text-gray-900 mb-4 group-hover:text-blue-600 transition-colors">
                                ${job.title}
                            </h4>
                            <div class="flex items-center justify-between mb-6">
                                <span class="text-gray-600 font-medium">${job.location}</span>
                                <span class="text-gray-500 text-sm">${job.duration}</span>
                            </div>
                            <button class="w-full bg-gray-100 text-gray-700 py-3 rounded-lg font-semibold hover:bg-blue-600 hover:text-white transition-all duration-300 group-hover:bg-blue-600 group-hover:text-white">
                                Easy Apply
                            </button>
                        `;
                        
                        jobsGrid.appendChild(jobCard);
                        
                        // Animate in
                        setTimeout(() => {
                            jobCard.style.opacity = '1';
                            jobCard.style.transform = 'translateY(0)';
                        }, 100);
                    });
                    
                    this.textContent = originalText;
                    this.disabled = false;
                    
                    showNotification('New jobs loaded!', 'success');
                }, 1500);
            });

            // Search functionality
            const searchButton = document.querySelector('button[class*="bg-gray-800"]');
            const searchInputs = document.querySelectorAll('input, select');
            
            searchButton.addEventListener('click', function() {
                const searchTerm = document.querySelector('input[placeholder*="What are you"]').value;
                const location = document.querySelector('select').value;
                const category = document.querySelectorAll('select')[1].value;
                
                // Simulate search (in real app, this would make an API call)
                if (searchTerm.trim() !== '' || location !== 'Location' || category !== 'Categories') {
                    // Show loading state
                    const originalText = this.innerHTML;
                    this.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Searching...';
                    this.disabled = true;
                    
                    setTimeout(() => {
                        this.innerHTML = originalText;
                        this.disabled = false;
                        alert('Searching for: ' + searchTerm + ' in ' + location + ', Category: ' + category);
                    }, 1500);
                }
            });

            // Job card interactions
            document.querySelectorAll('.bg-white.border').forEach(jobCard => {
                const applyButton = jobCard.querySelector('button');
                
                jobCard.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-5px)';
                });
                
                jobCard.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(0)';
                });
                
                applyButton.addEventListener('click', function(e) {
                    e.stopPropagation();
                    const jobTitle = jobCard.querySelector('h3').textContent;
                    const company = jobCard.querySelector('p.text-gray-600').textContent;
                    
                    // Simulate apply process
                    const originalText = this.textContent;
                    this.textContent = 'Melamar...';
                    this.disabled = true;
                    
                    setTimeout(() => {
                        this.textContent = 'Berhasil Dilamar';
                        this.classList.remove('hover:bg-blue-600', 'hover:text-white');
                        this.classList.add('bg-green-600', 'text-white');
                        
                        setTimeout(() => {
                            this.textContent = originalText;
                            this.classList.add('hover:bg-blue-600', 'hover:text-white');
                            this.classList.remove('bg-green-600', 'text-white');
                            this.disabled = false;
                        }, 2000);
                    }, 1000);
                });
            });

            // Category card hover effects
            document.querySelectorAll('.bg-white.p-6.rounded-xl').forEach(categoryCard => {
                categoryCard.addEventListener('mouseenter', function() {
                    this.style.transform = 'scale(1.05)';
                });
                
                categoryCard.addEventListener('mouseleave', function() {
                    this.style.transform = 'scale(1)';
                });
            });

            // Floating animation enhancement
            const floatingElements = document.querySelectorAll('.floating-avatar');
            floatingElements.forEach((element, index) => {
                element.style.animationDelay = `${index * 0.5}s`;
                element.style.animationDuration = `${4 + Math.random() * 4}s`;
            });

            // Intersection Observer for animations
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

            // Add fade-in animation to sections
            document.querySelectorAll('section').forEach(section => {
                section.style.opacity = '0';
                section.style.transform = 'translateY(30px)';
                section.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
                observer.observe(section);
            });

            // Mobile menu toggle (if needed)
            const mobileMenuButton = document.createElement('button');
            mobileMenuButton.innerHTML = '<i class="fas fa-bars"></i>';
            mobileMenuButton.className = 'md:hidden text-gray-700 hover:text-blue-600 p-2';
            
            const nav = document.querySelector('nav .flex.justify-between');
            nav.appendChild(mobileMenuButton);

            // Form validation for search
            searchInputs.forEach(input => {
                input.addEventListener('focus', function() {
                    this.style.borderColor = '#3B82F6';
                    this.style.boxShadow = '0 0 0 3px rgba(59, 130, 246, 0.1)';
                });
                
                input.addEventListener('blur', function() {
                    this.style.borderColor = '#E5E7EB';
                    this.style.boxShadow = 'none';
                });
            });

            // Newsletter subscription (if added later)
            function subscribeNewsletter(email) {
                return new Promise((resolve) => {
                    setTimeout(() => {
                        resolve({ success: true, message: 'Berhasil subscribe newsletter!' });
                    }, 1000);
                });
            }

            // Dynamic job count update
            function updateJobCounts() {
                const jobCountElements = document.querySelectorAll('[class*="jobs available"]');
                jobCountElements.forEach(element => {
                    const currentCount = parseInt(element.textContent);
                    const newCount = currentCount + Math.floor(Math.random() * 10);
                    element.textContent = `${newCount} jobs available`;
                });
            }

            // Update job counts every 30 seconds (simulate real-time updates)
            setInterval(updateJobCounts, 30000);

            // Keyboard navigation for accessibility
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Enter' && e.target.tagName === 'BUTTON') {
                    e.target.click();
                }
            });

            // Performance monitoring
            window.addEventListener('load', function() {
                console.log('Page loaded successfully');
                
                // Preload important images
                const importantImages = [
                    'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=100&h=100&fit=crop&crop=face',
                    'https://images.unsplash.com/photo-1494790108755-2616b612b786?w=100&h=100&fit=crop&crop=face'
                ];
                
                importantImages.forEach(src => {
                    const img = new Image();
                    img.src = src;
                });
            });
        });
    </script>
</body>
</html>