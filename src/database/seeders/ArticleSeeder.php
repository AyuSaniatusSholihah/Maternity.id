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

        // Get all categories for N:M relationships
        $categories = \App\Models\Category::all();

        $articles = [
            [
                'title' => 'Gejala Awal Kehamilan yang Perlu Diketahui',
                'keywords' => 'kehamilan, gejala, morning sickness, keterlambatan menstruasi',
                'short_description' => 'Pelajari tanda-tanda awal kehamilan dan bagaimana membedakannya dari kondisi lain.',
                'content' => 'Kehamilan adalah momen istimewa yang ditandai dengan berbagai perubahan pada tubuh ibu. Gejala awal kehamilan biasanya muncul beberapa hari setelah pembuahan. Beberapa gejala awal kehamilan yang umum dialami antara lain keterlambatan menstruasi, morning sickness, dan kelelahan. Jika Anda mengalami gejala-gejala ini, sebaiknya lakukan tes kehamilan atau konsultasi dengan dokter untuk memastikan.',
                'category' => 'Gejala & Tanda',
            ],
            [
                'title' => 'Nutrisi Penting Selama Kehamilan Trimester Pertama',
                'keywords' => 'nutrisi, kehamilan, vitamin, folat, asam folat',
                'short_description' => 'Panduan lengkap tentang nutrisi dan vitamin yang dibutuhkan ibu hamil di trimester pertama.',
                'content' => 'Trimester pertama kehamilan adalah periode kritis untuk perkembangan janin. Asupan nutrisi yang tepat sangat penting untuk mendukung pertumbuhan dan perkembangan bayi. Nutrisi penting termasuk asam folat, kalsium, protein, zat besi, iodine, dan vitamin C. Konsultasikan dengan dokter atau ahli gizi tentang suplemen prenatal yang tepat untuk Anda.',
                'category' => 'Nutrisi & Gizi',
            ],
            [
                'title' => 'Cara Mengatasi Morning Sickness dengan Aman',
                'keywords' => 'morning sickness, mual, muntah, tips, pencegahan',
                'short_description' => 'Tips praktis dan aman untuk mengatasi mual muntah di pagi hari selama kehamilan.',
                'content' => 'Morning sickness atau mual muntah adalah salah satu gejala paling umum di awal kehamilan. Tips mengatasi termasuk makan dalam porsi kecil tapi sering, minum air putih yang cukup, dan konsumsi makanan sehat. Jahe dan lemon terbukti membantu mengurangi mual. Jika mual dan muntah sangat parah, segera hubungi dokter.',
                'category' => 'Gejala & Tanda',
            ],
            [
                'title' => 'Olahraga Aman untuk Ibu Hamil',
                'keywords' => 'olahraga, kehamilan, fitness, senam ibu hamil',
                'short_description' => 'Panduan olahraga yang aman dan bermanfaat untuk ibu hamil di setiap trimester.',
                'content' => 'Olahraga teratur selama kehamilan sangat bermanfaat untuk kesehatan ibu dan bayi. Olahraga aman saat hamil termasuk jalan cepat, berenang, yoga ibu hamil, dan senam ibu hamil. Hindari olahraga kontak dan aktivitas berisiko tinggi. Lakukan olahraga 150 menit per minggu dan tetap terhidrasi.',
                'category' => 'Olahraga & Kebugaran',
            ],
            [
                'title' => 'Perubahan Fisik dan Psikologis pada Ibu Hamil',
                'keywords' => 'perubahan fisik, perubahan psikologis, kehamilan, emosi',
                'short_description' => 'Pahami perubahan yang akan terjadi pada tubuh dan pikiran selama kehamilan.',
                'content' => 'Kehamilan adalah perjalanan yang luar biasa dengan berbagai perubahan fisik dan psikologis. Perubahan hormon, pembesaran rahim, dan peningkatan volume darah adalah bagian dari proses. Mood swings dan kecemasan adalah reaksi psikologis yang wajar. Penting untuk berbicara dengan orang terkasih jika Anda merasa kewalahan.',
                'category' => 'Kesehatan Mental',
            ],
            [
                'title' => 'Panduan Pola Makan Sehat untuk Ibu Hamil Trimester Kedua',
                'keywords' => 'pola makan, nutrisi, trimester kedua, makanan sehat',
                'short_description' => 'Rekomendasi makanan dan pola makan yang tepat untuk ibu hamil memasuki trimester kedua.',
                'content' => 'Trimester kedua adalah periode pertumbuhan pesat janin. Ibu hamil memerlukan kalori tambahan sekitar 300-350 kal per hari. Fokus pada makanan kaya zat besi, kalsium, dan protein. Konsumsi buah-buahan, sayuran, biji-bijian, dan produk susu secara teratur untuk memastikan kebutuhan nutrisi terpenuhi.',
                'category' => 'Nutrisi & Gizi',
            ],
            [
                'title' => 'Pemeriksaan Kesehatan Rutin Selama Kehamilan',
                'keywords' => 'pemeriksaan, kesehatan, kontrol kehamilan, USG',
                'short_description' => 'Jadwal dan pentingnya pemeriksaan kesehatan rutin saat hamil untuk memantau perkembangan bayi.',
                'content' => 'Pemeriksaan kesehatan rutin sangat penting untuk memantau kesehatan ibu dan perkembangan bayi. Pemeriksaan awal biasanya dilakukan pada minggu ke-8 hingga ke-12. USG akan dilakukan untuk melihat perkembangan janin. Setelah itu, pemeriksaan dilakukan setiap bulan hingga minggu ke-28, kemudian dua minggu sekali.',
                'category' => 'Pemeriksaan Medis',
            ],
            [
                'title' => 'Manajemen Stres dan Kesehatan Mental Ibu Hamil',
                'keywords' => 'stres, kesehatan mental, relaksasi, keseimbangan',
                'short_description' => 'Strategi mengelola stres dan menjaga kesehatan mental selama masa kehamilan.',
                'content' => 'Stres berlebihan selama kehamilan dapat mempengaruhi kesehatan ibu dan bayi. Teknik relaksasi seperti meditasi, yoga, dan pernapasan dalam dapat membantu. Cukup istirahat, berkomunikasi dengan keluarga, dan menjalani hobi menyenangkan juga bermanfaat. Jangan ragu untuk mencari bantuan profesional jika merasa depresi atau cemas.',
                'category' => 'Kesehatan Mental',
            ],
            [
                'title' => 'Persiapan Persalinan: Apa yang Perlu Diketahui',
                'keywords' => 'persalinan, persiapan, natural, caesar, epidural',
                'short_description' => 'Panduan lengkap persiapan persalinan dan pilihan metode persalinan yang tersedia.',
                'content' => 'Ada berbagai pilihan metode persalinan: persalinan normal, caesar, atau dengan bantuan vakum/forseps. Pelajari keuntungan dan risiko masing-masing metode. Kelas persiapan persalinan dapat membantu memahami proses dan teknik pernapasan. Diskusikan dengan dokter tentang preferensi dan rencana persalinan Anda untuk hasil terbaik.',
                'category' => 'Persalinan & Kelahiran',
            ],
            [
                'title' => 'Tanda Bahaya Kehamilan yang Harus Diwaspadai',
                'keywords' => 'bahaya, tanda bahaya, kehamilan, darurat',
                'short_description' => 'Pelajari tanda-tanda bahaya kehamilan yang memerlukan perhatian medis segera.',
                'content' => 'Beberapa tanda bahaya kehamilan memerlukan perhatian medis segera: pendarahan berat, nyeri perut yang sangat parah, pusing berat, bengkak berlebihan, dan tekanan darah tinggi. Juga waspada terhadap cairan amnion yang keluar dan kontraksi awal sebelum minggu ke-37. Jika mengalami gejala tersebut, segera hubungi dokter atau pergi ke rumah sakit terdekat.',
                'category' => 'Keamanan & Bahaya',
            ],
            [
                'title' => 'Kesehatan Gigi dan Mulut Selama Kehamilan',
                'keywords' => 'kesehatan gigi, kehamilan, gingivitis, kebersihan mulut',
                'short_description' => 'Pentingnya menjaga kesehatan gigi dan mulut selama kehamilan untuk mencegah komplikasi.',
                'content' => 'Perubahan hormon selama kehamilan dapat menyebabkan gingivitis dan masalah gigi lainnya. Sikat gigi dua kali sehari dengan sikat lembut dan gunakan benang gigi. Kunjungi dokter gigi untuk pembersihan profesional. Hindari terlalu banyak makanan manis dan minuman asam yang dapat merusak gigi. Kesehatan gigi yang baik juga penting untuk mencegah infeksi yang dapat mempengaruhi kehamilan.',
                'category' => 'Gaya Hidup',
            ],
            [
                'title' => 'Manfaat dan Risiko Screening Prenatal',
                'keywords' => 'screening, prenatal, tes, risiko, manfaat',
                'short_description' => 'Penjelasan berbagai tes screening prenatal dan keputusan yang perlu Anda buat.',
                'content' => 'Screening prenatal termasuk tes darah dan USG untuk mendeteksi kelainan kromosom. Tes ini mencakup first trimester screening, quad screen, dan amniocentesis. Setiap tes memiliki manfaat dan risiko yang perlu dipertimbangkan. Diskusikan dengan dokter tentang tes mana yang tepat untuk Anda berdasarkan usia dan riwayat kesehatan keluarga.',
                'category' => 'Pemeriksaan Medis',
            ],
            [
                'title' => 'Penyesuaian Gaya Hidup Untuk Kehamilan yang Sehat',
                'keywords' => 'gaya hidup, kehamilan, henti merokok, hindari alkohol',
                'short_description' => 'Perubahan gaya hidup yang direkomendasikan untuk mendukung kehamilan yang sehat dan aman.',
                'content' => 'Menghindari merokok dan alkohol sangat penting selama kehamilan. Merokok dapat menyebabkan pertumbuhan bayi terhambat dan komplikasi persalinan. Alkohol dapat menyebabkan cacat janin. Hindari juga obat-obatan terlarang dan hati-hati dengan obat resep. Dapatkan tidur yang cukup, tetap aktif, dan jaga pola makan seimbang untuk kehamilan yang optimal.',
                'category' => 'Gaya Hidup',
            ],
            [
                'title' => 'Ikatan Batin Dengan Bayi Selama Kehamilan',
                'keywords' => 'ikatan, bonding, bayi, kehamilan, hubungan',
                'short_description' => 'Cara membangun ikatan emosional dengan bayi sejak dalam kandungan.',
                'content' => 'Bonding dengan bayi dapat dimulai sejak kehamilan. Berbicara, menyanyi, dan membaca untuk perut Anda dapat membantu bayi mengenali suara Anda. Sentuhan lembut pada perut juga dapat memberikan stimulasi positif. Melibatkan pasangan dan keluarga dalam proses ini memperkuat ikatan keluarga. Ikatan kuat ini bermanfaat untuk perkembangan emosional dan kognitif bayi setelah lahir.',
                'category' => 'Kesehatan Mental',
            ],
            [
                'title' => 'Persiapan Pasangan Dalam Mendampingi Ibu Hamil',
                'keywords' => 'pasangan, dukungan, peran ayah, persiapan',
                'short_description' => 'Panduan bagi pasangan untuk memberikan dukungan optimal selama kehamilan dan persalinan.',
                'content' => 'Pasangan memiliki peran penting dalam mendukung ibu hamil. Hadir dalam pemeriksaan kesehatan, membantu pekerjaan rumah tangga, dan memberikan dukungan emosional sangat berarti. Ikut serta dalam kelas persiapan persalinan dan memahami kebutuhan ibu hamil akan membantu. Pasangan juga perlu mempersiapkan diri menjadi ayah dengan membaca tentang perawatan bayi dan terlibat aktif.',
                'category' => 'Kesehatan Mental',
            ],
            [
                'title' => 'Obat-obatan yang Aman dan Tidak Aman Saat Hamil',
                'keywords' => 'obat-obatan, kehamilan, keamanan, efek samping',
                'short_description' => 'Informasi lengkap tentang obat-obatan yang aman dikonsumsi selama kehamilan.',
                'content' => 'Tidak semua obat aman dikonsumsi selama kehamilan. Beberapa obat dapat menyebabkan cacat janin atau masalah perkembangan. Sebelum mengonsumsi obat apa pun, konsultasikan dengan dokter kandungan. Obat-obatan umum seperti parasetamol biasanya aman, tetapi hindari ibuprofen dan aspirin di trimester ketiga. Obat penenang dan obat tidur tertentu harus dihindari kecuali atas rekomendasi dokter.',
                'category' => 'Keamanan & Bahaya',
            ],
            [
                'title' => 'Kesiapan Rumah dan Perlengkapan Bayi',
                'keywords' => 'persiapan rumah, perlengkapan bayi, nursery, peralatan',
                'short_description' => 'Checklist lengkap perlengkapan bayi dan persiapan rumah untuk kedatangan bayi baru.',
                'content' => 'Persiapan rumah untuk bayi baru sangat penting. Siapkan tempat tidur bayi yang aman, pakaian bayi, popok, botol minum, dan perlengkapan mandi. Pastikan rumah aman dari benda-benda yang berbahaya. Beli peralatan penting seperti stroller, car seat, dan tas bayi. Jangan lupa perlengkapan ibu seperti bantal menyusui dan bantalan payudara. Mulai persiapan setidaknya 2-3 bulan sebelum tanggal perkiraan lahir.',
                'category' => 'Persiapan & Kelahiran',
            ],
            [
                'title' => 'Nutrisi Postpartum dan Pemulihan Setelah Persalinan',
                'keywords' => 'postpartum, nutrisi, pemulihan, menyusui, istirahat',
                'short_description' => 'Panduan nutrisi dan perawatan diri setelah persalinan untuk pemulihan optimal.',
                'content' => 'Periode postpartum sangat penting untuk pemulihan ibu. Konsumsi makanan bergizi lengkap untuk mengembalikan energi dan mendukung produksi ASI jika menyusui. Istirahat yang cukup, pijat lembut, dan olahraga ringan dapat membantu pemulihan. Jangan lupakan kesehatan mental; postpartum blues adalah hal yang wajar. Jangan ragu untuk meminta bantuan keluarga atau mencari dukungan profesional jika diperlukan.',
                'category' => 'Nutrisi & Gizi',
            ],
            [
                'title' => 'Tanda-tanda Komplikasi Kehamilan dan Kapan Mencari Bantuan',
                'keywords' => 'komplikasi, kehamilan, tanda bahaya, preeklampsia, diabetes',
                'short_description' => 'Pelajari komplikasi kehamilan umum dan tanda-tanda yang memerlukan penanganan medis.',
                'content' => 'Komplikasi kehamilan dapat terjadi pada siapa saja. Preeklampsia ditandai dengan tekanan darah tinggi dan protein dalam urin. Diabetes gestasional dapat berkembang selama kehamilan. Anemia dan infeksi juga mungkin terjadi. Pendarahan berlebihan, kepala pusing, dan pandangan kabur memerlukan perhatian segera. Pemeriksaan rutin membantu mendeteksi komplikasi sejak dini. Komunikasikan semua keluhan kepada dokter untuk penanganan terbaik.',
                'category' => 'Keamanan & Bahaya',
            ],
            [
                'title' => 'Keterlibatan Keluarga Besar dalam Pengasuhan Bayi',
                'keywords' => 'keluarga, pengasuhan, dukungan, tradisi, keseimbangan',
                'short_description' => 'Bagaimana menyeimbangkan masukan keluarga dengan keputusan parenting modern.',
                'content' => 'Keluarga besar sering memberikan masukan tentang pengasuhan bayi. Penting untuk menghargai pengalaman mereka sambil tetap membuat keputusan berdasarkan pengetahuan modern. Komunikasikan dengan jelas tentang preferensi parenting Anda. Buat batasan yang sehat namun tetap terbuka untuk dukungan. Keseimbangan antara tradisi dan inovasi akan menciptakan lingkungan pengasuhan yang harmonis untuk bayi dan keluarga.',
                'category' => 'Perawatan Bayi',
            ],
            [
                'title' => 'Kesehatan Reproduksi Setelah Persalinan',
                'keywords' => 'reproduksi, postpartum, kontrasepsi, kesehatan seksual',
                'short_description' => 'Informasi tentang kesehatan reproduksi dan pilihan kontrasepsi setelah melahirkan.',
                'content' => 'Setelah persalinan, penting untuk memperhatikan kesehatan reproduksi. Istirahat setidaknya 6 minggu sebelum melakukan aktivitas seksual. Berbagai pilihan kontrasepsi tersedia tergantung pada situasi masing-masing, termasuk pil, IUD, dan sterilisasi. Jika menyusui, beberapa kontrasepsi lebih disarankan daripada yang lain. Konsultasikan dengan dokter tentang pilihan terbaik untuk kebutuhan Anda dan rencana keluarga di masa depan.',
                'category' => 'Gaya Hidup',
            ],
        ];

        foreach ($articles as $article) {
            $categoryName = $article['category'];
            $category = $categories->where('name', $categoryName)->first();
            
            Article::create([
                'id' => Str::uuid(),
                'title' => $article['title'],
                'slug' => Str::slug($article['title']),
                'description' => $article['short_description'],
                'content' => $article['content'],
                'image_url' => null,
                'categories' => $category?->id,
                'author' => $admin->account_id,
            ]);
        }
    }
}
