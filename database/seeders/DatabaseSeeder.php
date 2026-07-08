<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Certificate;
use App\Models\Course;
use App\Models\Material;
use App\Models\Order;
use App\Models\Review;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Create Users
        $admin = User::create([
            'name' => 'Admin WIB',
            'email' => 'admin@wib.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'tier' => 'free',
            'is_active' => true,
        ]);

        $pengajar1 = User::create([
            'name' => 'Dr. Ahmad Rizki',
            'email' => 'pengajar1@wib.com',
            'password' => Hash::make('password'),
            'role' => 'pengajar',
            'tier' => 'free',
            'is_active' => true,
        ]);

        $pengajar2 = User::create([
            'name' => 'Siti Nurhaliza',
            'email' => 'pengajar2@wib.com',
            'password' => Hash::make('password'),
            'role' => 'pengajar',
            'tier' => 'free',
            'is_active' => true,
        ]);

        $pesertaFree1 = User::create([
            'name' => 'Budi Santoso',
            'email' => 'budi@example.com',
            'password' => Hash::make('password'),
            'role' => 'peserta',
            'tier' => 'free',
            'is_active' => true,
        ]);

        $pesertaFree2 = User::create([
            'name' => 'Ani Wijaya',
            'email' => 'ani@example.com',
            'password' => Hash::make('password'),
            'role' => 'peserta',
            'tier' => 'free',
            'is_active' => true,
        ]);

        $pesertaFree3 = User::create([
            'name' => 'Dedi Prasetyo',
            'email' => 'dedi@example.com',
            'password' => Hash::make('password'),
            'role' => 'peserta',
            'tier' => 'free',
            'is_active' => true,
        ]);

        $pesertaApik = User::create([
            'name' => 'Rina Kusuma',
            'email' => 'rina@example.com',
            'password' => Hash::make('password'),
            'role' => 'peserta',
            'tier' => 'apik',
            'theme' => 'apik',
            'border_style' => 'solid',
            'is_active' => true,
        ]);

        $pesertaSangar = User::create([
            'name' => 'Joko Widodo',
            'email' => 'joko@example.com',
            'password' => Hash::make('password'),
            'role' => 'peserta',
            'tier' => 'sangar',
            'theme' => 'sangar',
            'border_style' => 'double',
            'is_active' => true,
        ]);

        // 2. Create Categories
        $programming = Category::create([
            'name' => 'Programming',
            'slug' => 'programming',
            'description' => 'Learn various programming languages and frameworks',
            'is_active' => true,
        ]);

        $design = Category::create([
            'name' => 'Design',
            'slug' => 'design',
            'description' => 'Master UI/UX design and graphic design',
            'is_active' => true,
        ]);

        $business = Category::create([
            'name' => 'Business',
            'slug' => 'business',
            'description' => 'Develop your business and entrepreneurship skills',
            'is_active' => true,
        ]);

        $dataScience = Category::create([
            'name' => 'Data Science',
            'slug' => 'data-science',
            'description' => 'Explore data analysis, machine learning, and AI',
            'is_active' => true,
        ]);

        // 3. Create Courses
        $courses = [];

        $courses[] = Course::create([
            'category_id' => $programming->id,
            'pengajar_id' => $pengajar1->id,
            'title' => 'Laravel Web Development Mastery',
            'slug' => 'laravel-web-development-mastery',
            'description' => 'Learn to build modern web applications with Laravel framework from scratch to deployment.',
            'is_active' => true,
            'created_by' => $admin->id,
        ]);

        $courses[] = Course::create([
            'category_id' => $programming->id,
            'pengajar_id' => $pengajar1->id,
            'title' => 'React & TypeScript Complete Guide',
            'slug' => 'react-typescript-complete-guide',
            'description' => 'Master React with TypeScript for building scalable frontend applications.',
            'is_active' => true,
            'created_by' => $admin->id,
        ]);

        $courses[] = Course::create([
            'category_id' => $design->id,
            'pengajar_id' => $pengajar2->id,
            'title' => 'UI/UX Design Fundamentals',
            'slug' => 'uiux-design-fundamentals',
            'description' => 'Learn the principles of user interface and user experience design.',
            'is_active' => true,
            'created_by' => $admin->id,
        ]);

        $courses[] = Course::create([
            'category_id' => $design->id,
            'pengajar_id' => $pengajar2->id,
            'title' => 'Figma for Beginners',
            'slug' => 'figma-for-beginners',
            'description' => 'Master Figma design tool from basic to advanced techniques.',
            'is_active' => true,
            'created_by' => $admin->id,
        ]);

        $courses[] = Course::create([
            'category_id' => $business->id,
            'pengajar_id' => $pengajar1->id,
            'title' => 'Digital Marketing Strategy',
            'slug' => 'digital-marketing-strategy',
            'description' => 'Learn effective digital marketing strategies for your business.',
            'is_active' => true,
            'created_by' => $admin->id,
        ]);

        $courses[] = Course::create([
            'category_id' => $business->id,
            'pengajar_id' => $pengajar2->id,
            'title' => 'Startup Business Planning',
            'slug' => 'startup-business-planning',
            'description' => 'Create a solid business plan for your startup venture.',
            'is_active' => true,
            'created_by' => $admin->id,
        ]);

        $courses[] = Course::create([
            'category_id' => $dataScience->id,
            'pengajar_id' => $pengajar1->id,
            'title' => 'Python for Data Analysis',
            'slug' => 'python-for-data-analysis',
            'description' => 'Learn Python programming for data analysis and visualization.',
            'is_active' => true,
            'created_by' => $admin->id,
        ]);

        $courses[] = Course::create([
            'category_id' => $dataScience->id,
            'pengajar_id' => $pengajar2->id,
            'title' => 'Machine Learning Basics',
            'slug' => 'machine-learning-basics',
            'description' => 'Introduction to machine learning algorithms and applications.',
            'is_active' => true,
            'created_by' => $admin->id,
        ]);

        // 4. Create Materials for each course
        foreach ($courses as $course) {
            for ($i = 1; $i <= 3; $i++) {
                Material::create([
                    'course_id' => $course->id,
                    'title' => "Introduction - Part {$i}",
                    'content_type' => 'video',
                    'content' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
                    'order' => $i,
                    'tier_required' => 'free',
                    'duration_minutes' => 15,
                    'is_published' => true,
                ]);
            }

            for ($i = 4; $i <= 6; $i++) {
                Material::create([
                    'course_id' => $course->id,
                    'title' => "Advanced Concepts - Part " . ($i - 3),
                    'content_type' => 'video',
                    'content' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
                    'order' => $i,
                    'tier_required' => 'apik',
                    'duration_minutes' => 25,
                    'is_published' => true,
                ]);
            }

            for ($i = 7; $i <= 8; $i++) {
                Material::create([
                    'course_id' => $course->id,
                    'title' => "Expert Level - Part " . ($i - 6),
                    'content_type' => 'text',
                    'content' => '<h2>Expert Content</h2><p>Exclusive content for Sangar tier.</p>',
                    'order' => $i,
                    'tier_required' => 'sangar',
                    'duration_minutes' => 30,
                    'is_published' => true,
                ]);
            }
        }

        // 5. Create Orders
        Order::create([
            'user_id' => $pesertaFree1->id,
            'order_number' => 'WIB-' . now()->format('Ymd') . '-A1B2',
            'tier_purchased' => 'apik',
            'amount' => 12345,
            'status' => 'pending_verification',
            'payment_proof' => 'payment-proofs/proof1.jpg',
        ]);

        Order::create([
            'user_id' => $pesertaFree2->id,
            'order_number' => 'WIB-' . now()->format('Ymd') . '-C3D4',
            'tier_purchased' => 'sangar',
            'amount' => 67891,
            'status' => 'pending_verification',
            'payment_proof' => 'payment-proofs/proof2.jpg',
        ]);

        Order::create([
            'user_id' => $pesertaApik->id,
            'order_number' => 'WIB-' . now()->format('Ymd') . '-E5F6',
            'tier_purchased' => 'apik',
            'amount' => 12345,
            'status' => 'accepted',
            'verified_by' => $admin->id,
            'verified_at' => now()->subDays(7),
        ]);

        Order::create([
            'user_id' => $pesertaSangar->id,
            'order_number' => 'WIB-' . now()->format('Ymd') . '-G7H8',
            'tier_purchased' => 'sangar',
            'amount' => 67891,
            'status' => 'accepted',
            'verified_by' => $admin->id,
            'verified_at' => now()->subDays(14),
        ]);

        Order::create([
            'user_id' => $pesertaFree3->id,
            'order_number' => 'WIB-' . now()->format('Ymd') . '-I9J0',
            'tier_purchased' => 'apik',
            'amount' => 12345,
            'status' => 'rejected',
            'verified_by' => $admin->id,
            'verified_at' => now()->subDays(3),
            'rejection_reason' => 'Payment proof is unclear. Please upload a clearer image.',
        ]);

        // 6. Create Reviews
        $reviewsData = [
            ['user' => $pesertaApik, 'course' => $courses[0], 'rating' => 5, 'comment' => 'Kursus yang luar biasa! Sangat detail dan dijelaskan dengan baik.'],
            ['user' => $pesertaApik, 'course' => $courses[1], 'rating' => 4, 'comment' => 'Konten yang bagus, bisa ditambah lebih banyak contoh.'],
            ['user' => $pesertaSangar, 'course' => $courses[0], 'rating' => 5, 'comment' => 'Kursus Laravel terbaik!'],
            ['user' => $pesertaSangar, 'course' => $courses[2], 'rating' => 4, 'comment' => 'Sangat informatif dan praktis.'],
            ['user' => $pesertaSangar, 'course' => $courses[3], 'rating' => 5, 'comment' => 'Sempurna untuk pemula!'],
            ['user' => $pesertaFree1, 'course' => $courses[4], 'rating' => 4, 'comment' => 'Pengantar yang bagus untuk digital marketing.'],
            ['user' => $pesertaFree2, 'course' => $courses[5], 'rating' => 3, 'comment' => 'Cukup bagus, perlu lebih banyak studi kasus.'],
            ['user' => $pesertaFree3, 'course' => $courses[6], 'rating' => 5, 'comment' => 'Kursus Python yang luar biasa!'],
            ['user' => $pesertaApik, 'course' => $courses[7], 'rating' => 4, 'comment' => 'Good ML introduction.'],
            ['user' => $pesertaSangar, 'course' => $courses[4], 'rating' => 5, 'comment' => 'Practical strategies!'],
        ];

        foreach ($reviewsData as $reviewData) {
            Review::create([
                'user_id' => $reviewData['user']->id,
                'course_id' => $reviewData['course']->id,
                'rating' => $reviewData['rating'],
                'comment' => $reviewData['comment'],
                'is_approved' => true,
            ]);
        }

        // 7. Create Certificates
        $certificatesData = [
            ['user' => $pesertaApik, 'course' => $courses[0]],
            ['user' => $pesertaApik, 'course' => $courses[1]],
            ['user' => $pesertaSangar, 'course' => $courses[0]],
        ];

        foreach ($certificatesData as $certData) {
            Certificate::create([
                'user_id' => $certData['user']->id,
                'course_id' => $certData['course']->id,
                'certificate_number' => 'CERT-WIB-' . now()->format('Ymd') . '-' . strtoupper(substr(md5($certData['user']->id . $certData['course']->id), 0, 4)),
                'issued_at' => now()->subDays(rand(1, 30)),
                'file_path' => 'certificates/cert-' . $certData['user']->id . '-' . $certData['course']->id . '.pdf',
            ]);
        }

        $this->command->info('✅ Database seeded successfully!');
        $this->command->info('');
        $this->command->info('📋 Test Credentials:');
        $this->command->info('  Admin:         admin@wib.com / password');
        $this->command->info('  Pengajar 1:    pengajar1@wib.com / password');
        $this->command->info('  Pengajar 2:    pengajar2@wib.com / password');
        $this->command->info('  Peserta Free:  budi@example.com / password');
        $this->command->info('  Peserta Apik:  rina@example.com / password');
        $this->command->info('  Peserta Sangar: joko@example.com / password');
    }
}
