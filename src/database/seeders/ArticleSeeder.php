<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Article;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ArticleSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the articles table.
     */
    public function run(): void
    {
        $admin = Admin::first();

        if (!$admin) {
            return;
        }

        $articles = [
            [
                'title' => 'Gejala Awal Kehamilan yang Perlu Diketahui',
                'keywords' => 'kehamilan, gejala, morning sickness, keterlambatan menstruasi',
                'short_description' => 'Pelajari tanda-tanda awal kehamilan dan bagaimana membedakannya dari kondisi lain.',
                'content' => 'Kehamilan adalah momen istimewa yang ditandai dengan berbagai perubahan pada tubuh ibu. Gejala awal kehamilan biasanya muncul beberapa hari setelah pembuahan. 

Beberapa gejala awal kehamilan yang umum dialami:

1. **Keterlambatan Menstruasi** - Ini adalah tanda paling jelas kehamilan. Jika siklus menstruasi Anda teratur dan tiba-tiba terlambat, ada kemungkinan Anda hamil.

2. **Morning Sickness** - Mual dan muntah biasanya terjadi pada pagi hari, meskipun bisa terjadi kapan saja. Ini disebabkan oleh perubahan hormon.

3. **Lelah dan Lesu** - Kadar hormon progesteron yang meningkat dapat menyebabkan kelelahan yang luar biasa.

4. **Perubahan Payudara** - Payudara mungkin terasa lebih sensitif, bengkak, atau sakit saat disentuh.

5. **Sering Buang Air Kecil** - Peningkatan hormon hCG dapat menyebabkan peningkatan aliran darah ke ginjal.

Jika Anda mengalami gejala-gejala ini, sebaiknya lakukan tes kehamilan atau konsultasi dengan dokter untuk memastikan.',
                'status' => 'published',
            ],
            [
                'title' => 'Nutrisi Penting Selama Kehamilan Trimester Pertama',
                'keywords' => 'nutrisi, kehamilan, vitamin, folat, asam folat',
                'short_description' => 'Panduan lengkap tentang nutrisi dan vitamin yang dibutuhkan ibu hamil di trimester pertama.',
                'content' => 'Trimester pertama kehamilan adalah periode kritis untuk perkembangan janin. Asupan nutrisi yang tepat sangat penting untuk mendukung pertumbuhan dan perkembangan bayi.

**Nutrisi Penting di Trimester Pertama:**

1. **Asam Folat (Vitamin B9)** - Sangat penting untuk perkembangan sistem saraf bayi. Sumber: sayuran hijau, telur, kacang-kacangan.

2. **Kalsium** - Dibutuhkan untuk pembentukan tulang bayi dan menjaga kesehatan tulang ibu. Sumber: susu, yoghurt, keju, brokoli.

3. **Protein** - Esensial untuk pertumbuhan bayi dan jaringan ibu. Sumber: daging, ikan, telur, kacang-kacangan.

4. **Zat Besi** - Membantu membawa oksigen ke bayi dan mencegah anemia. Sumber: daging merah, hati, bayam.

5. **Iodine** - Penting untuk perkembangan otak bayi. Sumber: ikan, produk susu, telur.

6. **Vitamin C** - Membantu penyerapan zat besi dan memperkuat imunitas. Sumber: jeruk, strawberry, paprika.

Konsultasikan dengan dokter atau ahli gizi tentang suplemen prenatal yang tepat untuk Anda.',
                'status' => 'published',
            ],
            [
                'title' => 'Cara Mengatasi Morning Sickness dengan Aman',
                'keywords' => 'morning sickness, mual, muntah, tips, pencegahan',
                'short_description' => 'Tips praktis dan aman untuk mengatasi mual muntah di pagi hari selama kehamilan.',
                'content' => 'Morning sickness atau mual muntah adalah salah satu gejala paling umum di awal kehamilan, yang dialami oleh 70-80% ibu hamil. Meskipun tidak berbahaya untuk bayi, gejala ini bisa mengganggu aktivitas sehari-hari.

**Tips Mengatasi Morning Sickness:**

1. **Makan Dalam Porsi Kecil Tapi Sering** - Hindari perut kosong karena dapat memperburuk mual. Makan 5-6 kali sehari dengan porsi kecil.

2. **Minum Air Putih yang Cukup** - Dehidrasi dapat memperparah mual. Minum air sedikit demi sedikit sepanjang hari.

3. **Konsumsi Makanan Sehat** - Pilih makanan yang mudah dicerna seperti buah, yoghurt, dan roti gandum.

4. **Hindari Makanan Berlemak dan Berbau Menyengat** - Makanan ini dapat memicu mual.

5. **Istirahat yang Cukup** - Kelelahan dapat memperberat mual. Pastikan Anda mendapat istirahat yang cukup.

6. **Konsumsi Jahe dan Lemon** - Keduanya terbukti membantu mengurangi mual. Bisa dalam bentuk teh atau permen.

7. **Vitamin B6** - Beberapa studi menunjukkan vitamin B6 dapat membantu mengurangi mual. Konsultasikan dengan dokter.

Jika mual dan muntah sangat parah hingga menyulitkan makan, segera hubungi dokter.',
                'status' => 'published',
            ],
            [
                'title' => 'Olahraga Aman untuk Ibu Hamil',
                'keywords' => 'olahraga, kehamilan, fitness, senam ibu hamil',
                'short_description' => 'Panduan olahraga yang aman dan bermanfaat untuk ibu hamil di setiap trimester.',
                'content' => 'Olahraga teratur selama kehamilan sangat bermanfaat untuk kesehatan ibu dan bayi. Namun, ada beberapa jenis olahraga yang lebih aman dibandingkan yang lain.

**Olahraga Aman Saat Hamil:**

1. **Jalan Cepat** - Salah satu olahraga terbaik untuk hamil. Mudah dilakukan dan cocok untuk semua trimester.

2. **Berenang** - Sangat baik karena mengurangi beban pada sendi dan otot. Juga membantu relaksasi.

3. **Yoga untuk Ibu Hamil** - Membantu fleksibilitas dan persiapan persalinan. Pilih kelas khusus ibu hamil.

4. **Senam Ibu Hamil** - Dirancang khusus untuk memperkuat otot yang dibutuhkan saat persalinan.

5. **Bersepeda Statis** - Aman dan baik untuk kesehatan kardiovaskular.

**Hindari Aktivitas:**
- Olahraga kontak seperti tinju atau bola basket
- Aktivitas berisiko tinggi seperti ski atau panjat tebing
- Olahraga yang bisa menyebabkan jatuh

**Tips Keselamatan:**
- Lakukan olahraga 150 menit per minggu atau 30 menit setiap hari
- Tetap terhidrasi
- Dengarkan tubuh Anda dan hentikan jika merasa tidak nyaman
- Konsultasikan dengan dokter sebelum memulai program olahraga

Olahraga yang cukup akan membantu Anda tetap bugar dan mempersiapkan diri untuk persalinan.',
                'status' => 'draft',
            ],
            [
                'title' => 'Perubahan Fisik dan Psikologis pada Ibu Hamil',
                'keywords' => 'perubahan fisik, perubahan psikologis, kehamilan, emosi',
                'short_description' => 'Pahami perubahan yang akan terjadi pada tubuh dan pikiran selama kehamilan.',
                'content' => 'Kehamilan adalah perjalanan yang luar biasa dengan berbagai perubahan fisik dan psikologis. Memahami perubahan ini dapat membantu Anda menjalani kehamilan dengan lebih nyaman.

**Perubahan Fisik:**

1. **Perubahan Hormon** - Kadar hormon estrogen dan progesteron meningkat drastis, mempengaruhi hampir setiap sistem tubuh.

2. **Pembesaran Rahim** - Rahim berkembang dari ukuran buah pir menjadi seukuran bola, memberikan tekanan pada organ lain.

3. **Peningkatan Volume Darah** - Meningkat hingga 50% untuk menyuplai kebutuhan janin.

4. **Perubahan Kulit** - Beberapa ibu mengalami perubahan pigmen (chloasma) atau stretch marks.

5. **Perubahan Payudara** - Payudara membesar dan dapat mengeluarkan kolostrum menjelang persalinan.

**Perubahan Psikologis:**

1. **Mood Swings** - Perubahan hormon dapat menyebabkan fluktuasi emosi yang cepat.

2. **Kecemasan dan Kekhawatiran** - Wajar merasa cemas tentang kesehatan bayi dan proses persalinan.

3. **Perubahan Body Image** - Beberapa ibu merasa tidak nyaman dengan perubahan bentuk tubuh mereka.

4. **Peningkatan Sensitivitas** - Menjadi lebih sensitif terhadap komentar dan kritik.

5. **Persiapan Mental** - Pikiran mulai beradaptasi dengan peran baru sebagai ibu.

Penting untuk berbicara dengan pasangan, keluarga, atau profesional kesehatan mental jika Anda merasa kewalahan.',
                'status' => 'published',
            ],
        ];

        foreach ($articles as $article) {
            Article::create([
                'title' => $article['title'],
                'keywords' => $article['keywords'],
                'slug' => Str::slug($article['title']),
                'short_description' => $article['short_description'],
                'content' => $article['content'],
                'thumbnail_image' => null,
                'status' => $article['status'],
                'author_id' => $admin->account_id,
            ]);
        }
    }
}
