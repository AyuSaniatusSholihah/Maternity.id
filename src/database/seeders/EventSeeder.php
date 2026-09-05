<?php

namespace Database\Seeders;

use App\Models\Event;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $events = [
            [
                'id' => 'e0000000-0000-0000-0000-000000000001',
                'name' => 'Mindful Motherhood',
                'slug' => 'mindful-motherhood',
                'mentor_name' => 'Rina Sasmita',
                'description' => 'Building mental resilience and community during early parenting stages with certified maternal psychologists.',
                'poster_img' => 'https://images.unsplash.com/photo-1531482615713-2afd69097998?auto=format&fit=crop&q=80&w=800',
                'date' => '2026-07-12',
                'location' => 'Zoom Webinar',
                'venue' => 'online',
                'status' => 'published',
                'is_available' => true,
                'price' => 0,
                'gc_invitation_link' => 'https://zoom.us/j/1234567890',
                'created_by' => 'a0000000-0000-0000-0000-000000000002',
            ],
            [
                'id' => 'e0000000-0000-0000-0000-000000000002',
                'name' => 'Holistic Hormone Health',
                'slug' => 'holistic-hormone-health',
                'mentor_name' => 'dr. Annisa Pratama',
                'description' => 'A deep dive into balancing your cycle and pregnancy hormones naturally with Dr. Jenkins & holistic midwives.',
                'poster_img' => 'https://images.unsplash.com/photo-1518611012118-696072aa579a?auto=format&fit=crop&q=80&w=800',
                'date' => '2026-07-14',
                'location' => 'Maternity Wellness Hub, Jakarta Selatan',
                'venue' => 'offline',
                'status' => 'published',
                'is_available' => true,
                'price' => 150000,
                'gc_invitation_link' => 'https://zoom.us/j/2345678901',
                'created_by' => 'a0000000-0000-0000-0000-000000000002',
            ],
            [
                'id' => 'e0000000-0000-0000-0000-000000000003',
                'name' => 'Prenatal Yoga for Calm and Strength',
                'slug' => 'prenatal-yoga-for-calm-and-strength',
                'mentor_name' => 'Bidan Kartika Sari',
                'description' => 'Gentle movement to support you and your baby during pregnancy, opening pelvic area safely for labor.',
                'poster_img' => 'https://images.unsplash.com/photo-1545205597-3d9d02c29597?auto=format&fit=crop&q=80&w=800',
                'date' => '2026-07-20',
                'location' => 'Google Meet',
                'venue' => 'online',
                'status' => 'published',
                'is_available' => true,
                'price' => 75000,
                'gc_invitation_link' => 'https://meet.google.com/abc-defg-hij',
                'created_by' => 'a0000000-0000-0000-0000-000000000004',
            ],
            [
                'id' => 'e0000000-0000-0000-0000-000000000004',
                'name' => 'Newborn Gentle Care and Baby Massage',
                'slug' => 'newborn-gentle-care-and-baby-massage',
                'mentor_name' => 'Bidan Kartika Sari',
                'description' => 'Praktik langsung pijat bayi untuk meredakan kolik, memperlancar tidur, dan merawat tali pusat bayi baru lahir.',
                'poster_img' => 'https://images.unsplash.com/photo-1555252333-9f8e92e65df9?auto=format&fit=crop&q=80&w=800',
                'date' => '2026-07-22',
                'location' => 'Grand City Hall, Surabaya',
                'venue' => 'offline',
                'status' => 'published',
                'is_available' => true,
                'price' => 120000,
                'gc_invitation_link' => 'https://zoom.us/j/3456789012',
                'created_by' => 'a0000000-0000-0000-0000-000000000004',
            ],
            [
                'id' => 'e0000000-0000-0000-0000-000000000005',
                'name' => 'Optimal Fetal Positioning and Hypnobirthing',
                'slug' => 'optimal-fetal-positioning-and-hypnobirthing',
                'mentor_name' => 'Konseler Gentle Birth Maya',
                'description' => 'Teknik pernapasan tiup-tiup saat kontraksi dan posisi senam panggul agar persalinan lancar minim trauma.',
                'poster_img' => 'https://images.unsplash.com/photo-1544005313-94ddf0286df2?auto=format&fit=crop&q=80&w=800',
                'date' => '2026-07-25',
                'location' => 'Zoom Webinar',
                'venue' => 'online',
                'status' => 'published',
                'is_available' => true,
                'price' => 0,
                'gc_invitation_link' => 'https://zoom.us/j/4567890123',
                'created_by' => 'a0000000-0000-0000-0000-000000000003',
            ],
            [
                'id' => 'e0000000-0000-0000-0000-000000000006',
                'name' => 'Meal Prep Nutrisi Trimester 3 dan Laktasi',
                'slug' => 'meal-prep-nutrisi-trimester-3-dan-laktasi',
                'mentor_name' => 'dr. Annisa Pratama',
                'description' => 'Panduan praktis memasak menu sehat kaya zat besi, kalsium, dan galaktagog alami untuk persiapan menyusui.',
                'poster_img' => 'https://images.unsplash.com/photo-1490818387583-1baba5e638af?auto=format&fit=crop&q=80&w=800',
                'date' => '2026-07-28',
                'location' => 'Dago Culinary & Health Studio, Bandung',
                'venue' => 'offline',
                'status' => 'published',
                'is_available' => true,
                'price' => 175000,
                'gc_invitation_link' => 'https://zoom.us/j/5678901234',
                'created_by' => 'a0000000-0000-0000-0000-000000000002',
            ],
            [
                'id' => 'e0000000-0000-0000-0000-000000000007',
                'name' => 'Perawatan Payudara dan Laktasi',
                'slug' => 'perawatan-payudara-dan-laktasi',
                'mentor_name' => 'Bidan Kartika Sari',
                'description' => 'Workshop lengkap perawatan payudara, teknik menyusui yang benar, dan mengatasi masalah laktasi.',
                'poster_img' => 'https://images.unsplash.com/photo-1545205597-3d9d02c29597?auto=format&fit=crop&q=80&w=800',
                'date' => '2026-08-05',
                'location' => 'Maternity Wellness Hub, Jogja',
                'venue' => 'offline',
                'status' => 'published',
                'is_available' => true,
                'price' => 100000,
                'gc_invitation_link' => 'https://zoom.us/j/6789012345',
                'created_by' => 'a0000000-0000-0000-0000-000000000004',
            ],
            [
                'id' => 'e0000000-0000-0000-0000-000000000008',
                'name' => 'Gentle Birth dan Birth Plan',
                'slug' => 'gentle-birth-dan-birth-plan',
                'mentor_name' => 'Rina Sasmita',
                'description' => 'Mempersiapkan pikiran dan tubuh untuk persalinan yang tenang dan minim trauma.',
                'poster_img' => 'https://images.unsplash.com/photo-1518611012118-696072aa579a?auto=format&fit=crop&q=80&w=800',
                'date' => '2026-08-10',
                'location' => 'Zoom Webinar',
                'venue' => 'online',
                'status' => 'published',
                'is_available' => true,
                'price' => 125000,
                'gc_invitation_link' => 'https://zoom.us/j/7890123456',
                'created_by' => 'a0000000-0000-0000-0000-000000000003',
            ],
        ];

        foreach ($events as $event) {
            Event::create($event);
        }
    }
}
