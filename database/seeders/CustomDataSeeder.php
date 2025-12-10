<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Program;
use Illuminate\Database\Seeder;

class CustomDataSeeder extends Seeder
{
    public function run(): void
    {
        // Get admin users
        $superadmin = User::where('role', 'superadmin')->first();
        $admin = User::where('role', 'admin')->first();

        // Kategori kegiatan pemerintah
        $categories = [
            [
                'name' => 'Pelayanan Publik',
                'description' => 'Kegiatan peningkatan kualitas pelayanan kepada masyarakat',
                'color' => '#3B82F6',
                'user_id' => $superadmin->id
            ],
            [
                'name' => 'Pembangunan Infrastruktur',
                'description' => 'Program pembangunan dan pemeliharaan infrastruktur daerah',
                'color' => '#10B981',
                'user_id' => $superadmin->id
            ],
            [
                'name' => 'Pendidikan & Pelatihan',
                'description' => 'Program peningkatan kapasitas SDM dan pendidikan masyarakat',
                'color' => '#F59E0B',
                'user_id' => $superadmin->id
            ],
            [
                'name' => 'Kesehatan Masyarakat',
                'description' => 'Program kesehatan dan kesejahteraan masyarakat',
                'color' => '#EF4444',
                'user_id' => $admin->id
            ],
            [
                'name' => 'Ekonomi & UMKM',
                'description' => 'Program pemberdayaan ekonomi dan pengembangan UMKM',
                'color' => '#8B5CF6',
                'user_id' => $admin->id
            ],
            [
                'name' => 'Lingkungan Hidup',
                'description' => 'Program pelestarian lingkungan dan pengelolaan sampah',
                'color' => '#059669',
                'user_id' => $admin->id
            ],
            [
                'name' => 'Keamanan & Ketertiban',
                'description' => 'Program keamanan dan ketertiban masyarakat',
                'color' => '#DC2626',
                'user_id' => $superadmin->id
            ],
            [
                'name' => 'Sosial & Budaya',
                'description' => 'Program sosial kemasyarakatan dan pelestarian budaya',
                'color' => '#7C3AED',
                'user_id' => $admin->id
            ],
        ];

        $createdCategories = [];
        foreach ($categories as $categoryData) {
            $createdCategories[] = Category::create($categoryData);
        }

        // Program kegiatan pemerintah
        $programs = [
            [
                'title' => 'Program Digitalisasi Pelayanan Publik',
                'description' => 'Implementasi sistem pelayanan publik berbasis digital untuk meningkatkan efisiensi dan transparansi. Program ini mencakup pengembangan aplikasi mobile, website, dan integrasi dengan sistem nasional seperti OSS dan SIPP.',
                'start_date' => '2025-01-15',
                'end_date' => '2025-06-30',
                'status' => 'Perencanaan',
                'budget' => 2500000000,
                'location' => 'Kantor Dinas Komunikasi dan Informatika',
                'is_public' => true,
                'user_id' => $superadmin->id,
                'categories' => [0, 2] // Pelayanan Publik, Pendidikan & Pelatihan
            ],
            [
                'title' => 'Pembangunan Jalan Tol Dalam Kota',
                'description' => 'Proyek pembangunan jalan tol sepanjang 25 km untuk mengurangi kemacetan dan meningkatkan konektivitas antar wilayah. Proyek ini melibatkan relokasi warga, pembebasan lahan, dan pembangunan infrastruktur pendukung.',
                'start_date' => '2025-02-01',
                'end_date' => '2027-12-31',
                'status' => 'Perencanaan',
                'budget' => 15000000000,
                'location' => 'Koridor Jakarta-Bogor',
                'is_public' => true,
                'user_id' => $admin->id,
                'categories' => [1] // Pembangunan Infrastruktur
            ],
            [
                'title' => 'Program Beasiswa Pendidikan Tinggi',
                'description' => 'Program pemberian beasiswa untuk mahasiswa berprestasi dari keluarga kurang mampu. Mencakup biaya kuliah, biaya hidup, dan program mentoring untuk memastikan keberhasilan studi.',
                'start_date' => '2025-03-01',
                'end_date' => '2025-12-31',
                'status' => 'Berjalan',
                'budget' => 500000000,
                'location' => 'Seluruh Universitas di Provinsi',
                'is_public' => true,
                'user_id' => $superadmin->id,
                'categories' => [2, 7] // Pendidikan & Pelatihan, Sosial & Budaya
            ],
            [
                'title' => 'Vaksinasi Massal COVID-19 Booster',
                'description' => 'Program vaksinasi booster COVID-19 untuk seluruh masyarakat dengan target 1 juta dosis. Melibatkan puskesmas, rumah sakit, dan pos vaksinasi keliling untuk menjangkau daerah terpencil.',
                'start_date' => '2025-01-10',
                'end_date' => '2025-04-30',
                'status' => 'Berjalan',
                'budget' => 750000000,
                'location' => 'Seluruh Fasilitas Kesehatan',
                'is_public' => true,
                'user_id' => $admin->id,
                'categories' => [3] // Kesehatan Masyarakat
            ],
            [
                'title' => 'Pemberdayaan UMKM Digital',
                'description' => 'Program pelatihan dan pendampingan UMKM untuk go digital melalui e-commerce, digital marketing, dan manajemen keuangan digital. Termasuk bantuan modal usaha dan akses ke platform marketplace.',
                'start_date' => '2025-02-15',
                'end_date' => '2025-11-30',
                'status' => 'Perencanaan',
                'budget' => 1200000000,
                'location' => 'Pusat Pelatihan UMKM',
                'is_public' => true,
                'user_id' => $superadmin->id,
                'categories' => [4, 2] // Ekonomi & UMKM, Pendidikan & Pelatihan
            ],
            [
                'title' => 'Program Bank Sampah Komunitas',
                'description' => 'Pengembangan sistem bank sampah di 50 kelurahan untuk mengurangi volume sampah dan meningkatkan ekonomi masyarakat. Program ini meliputi pelatihan pengelolaan sampah, penyediaan alat, dan pembentukan koperasi.',
                'start_date' => '2025-03-01',
                'end_date' => '2025-12-31',
                'status' => 'Perencanaan',
                'budget' => 800000000,
                'location' => '50 Kelurahan Pilot Project',
                'is_public' => true,
                'user_id' => $admin->id,
                'categories' => [5, 4] // Lingkungan Hidup, Ekonomi & UMKM
            ],
            [
                'title' => 'Sistem Keamanan Kota Cerdas (Smart City Security)',
                'description' => 'Implementasi sistem keamanan terintegrasi menggunakan CCTV AI, sensor IoT, dan command center 24/7. Sistem ini akan memantau titik-titik rawan dan memberikan respons cepat untuk situasi darurat.',
                'start_date' => '2025-04-01',
                'end_date' => '2025-10-31',
                'status' => 'Perencanaan',
                'budget' => 3000000000,
                'location' => 'Seluruh Area Strategis Kota',
                'is_public' => false,
                'user_id' => $superadmin->id,
                'categories' => [6, 1] // Keamanan & Ketertiban, Pembangunan Infrastruktur
            ],
            [
                'title' => 'Festival Budaya Nusantara',
                'description' => 'Penyelenggaraan festival budaya tahunan untuk melestarikan dan mempromosikan kebudayaan lokal. Meliputi pameran kerajinan, pertunjukan seni tradisional, kuliner khas, dan workshop budaya untuk generasi muda.',
                'start_date' => '2025-08-17',
                'end_date' => '2025-08-24',
                'status' => 'Perencanaan',
                'budget' => 400000000,
                'location' => 'Taman Budaya dan Alun-alun Kota',
                'is_public' => true,
                'user_id' => $admin->id,
                'categories' => [7, 4] // Sosial & Budaya, Ekonomi & UMKM
            ],
            [
                'title' => 'Renovasi Fasilitas Kesehatan Masyarakat',
                'description' => 'Program renovasi dan modernisasi 25 puskesmas dan 100 posyandu untuk meningkatkan kualitas pelayanan kesehatan. Termasuk penambahan peralatan medis, sistem informasi kesehatan, dan pelatihan tenaga medis.',
                'start_date' => '2025-05-01',
                'end_date' => '2025-12-31',
                'status' => 'Perencanaan',
                'budget' => 1800000000,
                'location' => 'Puskesmas dan Posyandu se-Kota',
                'is_public' => true,
                'user_id' => $superadmin->id,
                'categories' => [3, 1] // Kesehatan Masyarakat, Pembangunan Infrastruktur
            ],
            [
                'title' => 'Program Satu Data Indonesia',
                'description' => 'Implementasi sistem satu data untuk integrasi data antar OPD dan peningkatan transparansi pemerintahan. Program ini mencakup standardisasi data, pembangunan data warehouse, dan pelatihan pengelolaan data.',
                'start_date' => '2025-01-20',
                'end_date' => '2025-09-30',
                'status' => 'Perencanaan',
                'budget' => 1500000000,
                'location' => 'Seluruh OPD Pemerintah Daerah',
                'is_public' => false,
                'user_id' => $admin->id,
                'categories' => [0, 2] // Pelayanan Publik, Pendidikan & Pelatihan
            ],
        ];

        foreach ($programs as $programData) {
            $categoryIds = $programData['categories'];
            unset($programData['categories']);
            
            $program = Program::create($programData);
            
            // Attach categories
            $attachCategories = [];
            foreach ($categoryIds as $index) {
                if (isset($createdCategories[$index])) {
                    $attachCategories[] = $createdCategories[$index]->id;
                }
            }
            $program->categories()->attach($attachCategories);
        }
    }
}