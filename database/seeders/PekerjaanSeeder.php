<?php

namespace Database\Seeders;

use App\Models\Pekerjaan;
use App\Models\User;
use Illuminate\Database\Seeder;

class PekerjaanSeeder extends Seeder
{
    public function run(): void
    {
        // Get the first user or create one
        $user = User::first();
        
        if (!$user) {
            $user = User::factory()->create([
                'name' => 'Test User',
                'email' => 'test@example.com',
            ]);
        }


        Pekerjaan::create([
            'user_id' => $user->id,
            'judul_pekerjaan' => 'Full Stack Developer',
            'lokasi_pekerjaan' => 'Surabaya',
            'gaji_pekerjaan' => 'Rp 12.000.000',
            'kategori_pekerjaan' => 'technology',
            'jumlah_pelamar_diinginkan' => 4,
            'deskripsi_pekerjaan' => 'Kami sedang mencari Full Stack Developer yang versatile dan berpengalaman untuk mengembangkan aplikasi web end-to-end. Posisi ini cocok untuk developer yang menyukai tantangan dan ingin terlibat dalam seluruh siklus pengembangan aplikasi.

Tanggung Jawab:
• Mengembangkan aplikasi web full stack menggunakan MERN stack (MongoDB, Express.js, React.js, Node.js)
• Merancang dan mengimplementasikan user interface yang responsive dan user-friendly
• Membangun RESTful API dan GraphQL endpoints
• Mengintegrasikan database dan mengoptimalkan query performance
• Melakukan testing pada frontend dan backend components
• Berkolaborasi dengan product team untuk requirement analysis
• Maintain dan improve existing codebase
• Deploy aplikasi ke production environment

Kualifikasi:
• Minimal 2-3 tahun pengalaman sebagai Full Stack Developer
• Menguasai JavaScript (ES6+), React.js, Node.js, Express.js
• Pengalaman dengan MongoDB, PostgreSQL, atau database NoSQL/SQL lainnya
• Familiar dengan version control Git dan agile development
• Pengalaman dengan cloud platforms (AWS, Google Cloud, atau Azure)
• Pemahaman tentang web security dan best practices
• Kemampuan komunikasi yang baik dan teamwork

Tech Stack:
• Frontend: React.js, Redux, HTML5, CSS3, Bootstrap/Tailwind
• Backend: Node.js, Express.js, RESTful API, GraphQL
• Database: MongoDB, PostgreSQL, Redis
• Tools: Docker, Git, Jest, Webpack, Babel

Benefit:
• Gaji kompetitif dengan review tahunan
• Health insurance dan dental coverage
• Flexible working hours dan remote work options
• Annual bonus berdasarkan performance
• Learning budget untuk course dan conference
• Modern office dengan free snacks dan coffee
• Team outing dan company events',
            'status' => 'aktif',
            'tanggal_dibuat' => now(),
        ]);

        // Add some design jobs
        Pekerjaan::create([
            'user_id' => $user->id,
            'judul_pekerjaan' => 'UI/UX Designer',
            'lokasi_pekerjaan' => 'Jakarta',
            'gaji_pekerjaan' => 'Rp 7.000.000',
            'kategori_pekerjaan' => 'design',
            'jumlah_pelamar_diinginkan' => 2,
            'deskripsi_pekerjaan' => 'Kami mencari UI/UX Designer yang kreatif dan berpengalaman untuk bergabung dengan tim design kami. Kandidat ideal memiliki passion dalam menciptakan pengalaman pengguna yang exceptional dan desain yang memukau.

Tanggung Jawab:
• Melakukan user research dan analisis untuk memahami kebutuhan pengguna
• Membuat wireframes, mockups, dan prototypes untuk aplikasi web dan mobile
• Mendesain user interface yang menarik, intuitive, dan user-friendly
• Berkolaborasi dengan product manager dan developer untuk implementasi design
• Melakukan usability testing dan iterasi berdasarkan feedback
• Membuat design system dan style guide untuk konsistensi brand
• Mengoptimalkan user experience berdasarkan data analytics dan user feedback

Kualifikasi:
• Minimal 2 tahun pengalaman sebagai UI/UX Designer
• Menguasai design tools seperti Figma, Adobe XD, Sketch, Adobe Creative Suite
• Pemahaman yang kuat tentang user-centered design principles
• Pengalaman dalam user research, persona development, dan journey mapping
• Portfolio yang menunjukkan proses design thinking dan problem-solving
• Kemampuan komunikasi visual yang excellent
• Familiar dengan HTML/CSS basics (nilai plus)

Skills yang Dibutuhkan:
• User Interface Design dan Visual Design
• User Experience Research dan Testing
• Prototyping dan Interaction Design
• Information Architecture
• Design Systems dan Component Libraries
• Responsive Design untuk berbagai device

Benefit:
• Gaji kompetitif dengan annual review
• Creative freedom dan environment yang supportive
• Latest design tools dan software licenses
• Flexible working hours dan hybrid work options
• Design conference dan workshop allowance
• Health insurance dan wellness program
• Creative team building dan design thinking sessions',
            'status' => 'aktif',
            'tanggal_dibuat' => now(),
        ]);

        Pekerjaan::create([
            'user_id' => $user->id,
            'judul_pekerjaan' => 'Graphic Designer',
            'lokasi_pekerjaan' => 'Bandung',
            'gaji_pekerjaan' => 'Rp 6.000.000',
            'kategori_pekerjaan' => 'design',
            'jumlah_pelamar_diinginkan' => 3,
            'deskripsi_pekerjaan' => 'Bergabunglah dengan tim kreatif kami sebagai Graphic Designer untuk menciptakan visual yang memukau dan komunikatif. Kami mencari designer yang memiliki eye for detail dan kemampuan storytelling melalui visual.

Tanggung Jawab:
• Membuat desain grafis untuk berbagai keperluan marketing dan branding
• Mengembangkan konsep visual untuk campaign digital dan print media
• Mendesain materi promosi seperti poster, flyer, banner, dan social media content
• Berkolaborasi dengan marketing team untuk mengembangkan brand identity
• Membuat ilustrasi dan infografis yang engaging dan informatif
• Memastikan konsistensi visual brand across all platforms
• Mengelola multiple projects dengan deadline yang ketat

Kualifikasi:
• Minimal 1-2 tahun pengalaman sebagai Graphic Designer
• Menguasai Adobe Creative Suite (Photoshop, Illustrator, InDesign)
• Pemahaman yang baik tentang typography, color theory, dan composition
• Portfolio yang menunjukkan kreativitas dan technical skills
• Kemampuan bekerja dalam tim dan menerima feedback konstruktif
• Familiar dengan design trends dan social media platforms
• Basic knowledge tentang motion graphics (nilai plus)

Benefit:
• Gaji kompetitif dengan creative bonus
• Adobe Creative Cloud license
• Flexible creative environment
• Design workshop dan training opportunities
• Health insurance dan annual leave
• Creative team collaboration dan brainstorming sessions',
            'status' => 'aktif',
            'tanggal_dibuat' => now(),
        ]);

        // Add some management jobs
        Pekerjaan::create([
            'user_id' => $user->id,
            'judul_pekerjaan' => 'Project Manager',
            'lokasi_pekerjaan' => 'Jakarta',
            'gaji_pekerjaan' => 'Rp 15.000.000',
            'kategori_pekerjaan' => 'management',
            'jumlah_pelamar_diinginkan' => 2,
            'deskripsi_pekerjaan' => 'Kami mencari Project Manager yang berpengalaman untuk memimpin dan mengelola proyek-proyek strategis perusahaan. Kandidat ideal memiliki kemampuan leadership yang kuat dan track record dalam menyelesaikan proyek tepat waktu dan sesuai budget.

Tanggung Jawab:
• Mengelola end-to-end project lifecycle dari perencanaan hingga implementasi
• Mengkoordinasikan tim lintas departemen untuk mencapai project objectives
• Membuat project timeline, resource allocation, dan risk management plan
• Monitoring project progress dan melakukan reporting kepada stakeholders
• Memfasilitasi komunikasi antara client, tim internal, dan vendor eksternal
• Mengidentifikasi dan mengatasi bottlenecks dalam project execution
• Memastikan project deliverables memenuhi quality standards dan requirements
• Melakukan post-project evaluation dan lessons learned documentation

Kualifikasi:
• Minimal 3-5 tahun pengalaman sebagai Project Manager
• Sertifikasi PMP, PRINCE2, atau Agile/Scrum certification (preferred)
• Pengalaman mengelola project dengan budget minimal 500 juta rupiah
• Excellent communication, negotiation, dan problem-solving skills
• Menguasai project management tools seperti MS Project, Jira, Asana, atau Trello
• Pemahaman tentang software development lifecycle dan business processes
• Kemampuan bekerja under pressure dan mengelola multiple projects

Benefit:
• Gaji kompetitif dengan performance-based bonus
• Leadership development program
• Project management certification sponsorship
• Comprehensive health insurance untuk keluarga
• Flexible working arrangement dan remote work options
• Annual company retreat dan team building activities',
            'status' => 'aktif',
            'tanggal_dibuat' => now(),
        ]);

        Pekerjaan::create([
            'user_id' => $user->id,
            'judul_pekerjaan' => 'Product Manager',
            'lokasi_pekerjaan' => 'Surabaya',
            'gaji_pekerjaan' => 'Rp 18.000.000',
            'kategori_pekerjaan' => 'management',
            'jumlah_pelamar_diinginkan' => 1,
            'deskripsi_pekerjaan' => 'Bergabunglah sebagai Product Manager untuk memimpin pengembangan produk digital yang inovatif. Kami mencari seseorang yang memiliki vision yang kuat dan kemampuan untuk mentranslasikan kebutuhan market menjadi produk yang sukses.

Tanggung Jawab:
• Mengelola product roadmap dan strategy dari konsep hingga market launch
• Melakukan market research dan competitive analysis untuk product positioning
• Berkolaborasi dengan engineering, design, dan marketing teams
• Mendefinisikan product requirements dan user stories untuk development team
• Menganalisis user behavior dan product metrics untuk continuous improvement
• Mengelola product backlog dan prioritas fitur berdasarkan business value
• Melakukan stakeholder management dan regular product updates
• Mengkoordinasikan product launch activities dan go-to-market strategy

Kualifikasi:
• Minimal 4-6 tahun pengalaman sebagai Product Manager atau Product Owner
• Strong analytical skills dengan pengalaman menggunakan data untuk decision making
• Pengalaman dengan product management tools seperti Jira, Confluence, Mixpanel
• Pemahaman tentang agile/scrum methodology dan software development process
• Excellent communication skills dan kemampuan presentasi
• Background dalam technology, business, atau design
• Experience dengan A/B testing dan product analytics
• MBA atau technical degree (preferred)

Key Skills:
• Product Strategy dan Roadmap Planning
• User Experience dan Customer Journey Mapping
• Data Analysis dan Metrics-driven Decision Making
• Stakeholder Management dan Cross-functional Collaboration
• Market Research dan Competitive Intelligence
• Agile Product Development

Benefit:
• Gaji kompetitif dengan equity options
• Product management training dan certification
• Conference dan networking event allowance
• Comprehensive benefits package
• Opportunity untuk memimpin product yang impact jutaan users
• Career growth path ke VP Product atau Chief Product Officer',
            'status' => 'aktif',
            'tanggal_dibuat' => now(),
        ]);

        // Add marketing job to make it 7 jobs total
        Pekerjaan::create([
            'user_id' => $user->id,
            'judul_pekerjaan' => 'Digital Marketing Specialist',
            'lokasi_pekerjaan' => 'Jakarta',
            'gaji_pekerjaan' => 'Rp 9.000.000',
            'kategori_pekerjaan' => 'marketing',
            'jumlah_pelamar_diinginkan' => 4,
            'deskripsi_pekerjaan' => 'Kami mencari Digital Marketing Specialist yang passionate dan data-driven untuk mengembangkan dan mengeksekusi strategi digital marketing yang inovatif. Kandidat ideal memiliki pemahaman mendalam tentang digital landscape dan trend terkini.

Tanggung Jawab:
• Mengembangkan dan mengeksekusi comprehensive digital marketing campaigns
• Mengelola social media platforms (Instagram, Facebook, LinkedIn, TikTok, Twitter)
• Membuat content strategy dan editorial calendar untuk berbagai digital channels
• Melakukan SEO/SEM optimization dan mengelola Google Ads campaigns
• Menganalisis campaign performance dan menyediakan actionable insights
• Berkolaborasi dengan creative team untuk mengembangkan engaging content
• Mengelola email marketing campaigns dan marketing automation
• Monitoring brand reputation dan engaging dengan online community

Kualifikasi:
• Minimal 2-3 tahun pengalaman dalam digital marketing atau related field
• Menguasai digital marketing tools seperti Google Analytics, Google Ads, Facebook Ads Manager
• Pengalaman dengan social media management tools (Hootsuite, Buffer, Sprout Social)
• Strong analytical skills dan kemampuan interpretasi data marketing metrics
• Excellent copywriting skills untuk berbagai digital platforms
• Pemahaman tentang SEO, SEM, dan content marketing best practices
• Familiar dengan marketing automation tools dan CRM systems
• Creative thinking dengan kemampuan problem-solving yang baik

Digital Marketing Skills:
• Social Media Marketing dan Community Management
• Search Engine Optimization (SEO) dan Search Engine Marketing (SEM)
• Content Marketing dan Copywriting
• Email Marketing dan Marketing Automation
• Performance Marketing dan Paid Advertising
• Analytics dan Data-driven Decision Making
• Influencer Marketing dan Partnership Management

Benefit:
• Gaji kompetitif dengan performance bonus
• Digital marketing course dan certification allowance
• Latest marketing tools dan software access
• Flexible working hours dan hybrid work model
• Creative freedom dalam campaign development
• Health insurance dan wellness program
• Marketing conference dan networking events',
            'status' => 'aktif',
            'tanggal_dibuat' => now(),
        ]);

    }
} 