# 2. Software Requirements Specification (SRS)

## 2.1 Pendahuluan
### 2.1.1 Tujuan Dokumen
Dokumen ini menjelaskan kebutuhan fungsional dan non-fungsional untuk pengembangan website Maternity.id, sebagai acuan bagi tim pengembang, desainer, dan pemangku kepentingan dalam membangun produk.

### 2.1.2 Ruang Lingkup Produk
Maternity.id adalah aplikasi berbasis website yang memungkinkan pengguna (ibu hamil/nifas) menemukan seminar/pelatihan maternitas melalui fitur filter katalog (topik, lokasi, format, harga), login menggunakan akun Google, berlangganan akses e-book (seluruh materi atau per seminar), serta membaca artikel edukasi SEO. Pembayaran langganan dikoordinasikan melalui WhatsApp Admin dan aktivasi akses dilakukan secara manual oleh Admin di panel admin. Owner/penyelenggara seminar dapat mengajukan kolaborasi promosi melalui fitur Ajukan Seminar. Tenaga profesional (dokter/instruktur) yang ingin mengadakan pelatihan mandiri dapat langsung menghubungi CP Tim Maternity.id via WhatsApp untuk layanan fasilitator event (Tour Guide Event) melalui tombol di halaman kemitraan. Admin mengelola konten, seminar, langganan pengguna, keuangan, artikel SEO, dan testimoni pengguna melalui panel admin. Testimoni pengguna ditampilkan pada bagian akhir landing page dan pada halaman checkout untuk meningkatkan kepercayaan calon peserta.

### 2.1.3 Definisi, Akronim, dan Singkatan
| Istilah | Definisi |
|---|---|
| SRS | Software Requirements Specification, dokumen spesifikasi kebutuhan perangkat lunak |
| Langganan Akses Ebook | Kategori langganan yang memberi akses ke seluruh materi/e-book di website selama rentang waktu yang dipilih saat pembayaran |
| Langganan Akses Seminar | Kategori langganan untuk mengikuti satu seminar tertentu, yang otomatis turut memberi akses e-book terkait seminar tersebut |
| Owner/Mitra | Pihak penyelenggara seminar/pelatihan yang mendaftarkan kegiatannya di platform |
| Member | Pengguna yang telah login menggunakan akun Google dan memiliki minimal satu langganan aktif |
| Guest | Pengunjung website yang belum login |
| Google OAuth | Metode autentikasi tunggal menggunakan akun Google, menggantikan login email/password |
| Artikel SEO | Konten/materi edukasi yang dipublikasikan agar mudah ditemukan mesin pencari, dengan tautan promosi seminar terkait di bagian akhir |
| Fasilitator Mitra / Tour Guide Event | Layanan Maternity.id yang membantu tenaga profesional (dokter/instruktur) menyelenggarakan pelatihan mandiri, mencakup penyiapan venue, logistik, dan nakes pendamping |
| Testimoni | Ulasan pengguna/peserta seminar yang dikurasi Admin, ditampilkan di bagian akhir landing page dan di halaman checkout untuk meningkatkan kepercayaan calon peserta |

## 2.2 Deskripsi Umum
### 2.2.1 Perspektif Produk
Maternity.id merupakan produk baru (greenfield), berupa aplikasi web responsif yang terintegrasi dengan kanal promosi TikTok, autentikasi Google OAuth, kanal komunikasi WhatsApp Admin untuk checkout langganan, dan modul artikel SEO untuk akuisisi pengguna organik dari mesin pencari.

### 2.2.2 Karakteristik Pengguna / Aktor
| Aktor | Deskripsi |
|---|---|
| Guest | Pengunjung yang mengakses landing page, katalog terbatas, dan artikel SEO tanpa login |
| Member | Pengguna dengan akun Google yang memiliki minimal satu langganan aktif (akses ebook dan/atau akses seminar tertentu) |
| Owner/Mitra Seminar | Penyelenggara seminar/pelatihan yang mengajukan kolaborasi dan mengelola informasi kegiatannya |
| Tenaga Profesional (Fasilitator Mitra) | Dokter/instruktur/profesional yang ingin mengadakan pelatihan mandiri dan meminta Maternity.id sebagai fasilitator (Tour Guide Event): venue, logistik, dan nakes pendamping |
| Admin | Pengelola internal Maternity.id yang mengatur konten, langganan pengguna, informasi seminar, artikel SEO, dan dashboard keuangan |

### 2.2.3 Batasan (Constraints)
- Tahap awal produk hanya melayani wilayah Solo dan Jogja.
- Login hanya mendukung akun Google (Google OAuth); tidak ada login email/password maupun fitur lupa password.
- Checkout/pembayaran langganan tidak diproses otomatis di website, melainkan melalui koordinasi WhatsApp Admin, dan aktivasi akses dilakukan manual oleh Admin.
- Notifikasi dan konfirmasi ke owner/mitra dilakukan melalui WhatsApp, bukan melalui sistem otomatis penuh pada versi awal.
- Aplikasi versi awal berbasis website (belum mobile-native).

### 2.2.4 Asumsi dan Ketergantungan
- Tersedia integrasi Google OAuth 2.0 untuk proses login.
- Tersedia akun bisnis TikTok resmi Maternity.id untuk distribusi konten promosi.
- Tersedia nomor WhatsApp Admin resmi untuk menangani checkout langganan.
- Pengguna memiliki akses internet dan perangkat yang mendukung browser modern.

## 2.3 Kebutuhan Fungsional (Functional Requirements)
| ID | Kebutuhan Fungsional | Aktor Terkait |
|---|---|---|
| FR-01 | Sistem harus menampilkan landing page berisi informasi umum, seminar unggulan (upcoming event), artikel SEO terbaru, dan info langganan | Guest |
| FR-02 | Sistem harus menyediakan navigasi atas (top navbar) berisi tautan cepat ke Info Seminar, Ebook/Library, dan Artikel | Guest, Member |
| FR-03 | Sistem harus mendukung login/registrasi akun tunggal menggunakan Google OAuth (tanpa email/password manual) | Guest, Calon Member, Member |
| FR-04 | Sistem harus menyediakan fitur filter katalog berdasarkan topik, lokasi, format, dan harga | Guest, Member |
| FR-05 | Sistem harus menyediakan dua kategori langganan yang dapat dipilih pengguna: (a) Langganan Akses Ebook (semua materi, sesuai rentang waktu pembayaran) dan (b) Langganan Akses Seminar (satu seminar tertentu) | Member |
| FR-06 | Sistem harus mengarahkan pengguna ke WhatsApp Admin untuk melakukan checkout/pembayaran pada kedua kategori langganan tersebut | Member, Admin/CS |
| FR-7 | Sistem harus otomatis memberikan akses e-book terkait pada pengguna dengan Langganan Akses Seminar, di samping akses ke seminar yang dipilih | Member |
| FR-9 | Sistem harus menyediakan panel admin bagi Admin untuk mengatur/menetapkan langganan tiap user (seminar spesifik atau akses ebook penuh) beserta masa berlakunya, tanpa memerlukan kode akses dari pengguna | Admin |
| FR-10 | Sistem harus menyediakan fitur pengajuan kolaborasi seminar(media partner) yang nanti diarahkan ke wa admin | Owner/Mitra |
| FR-11 | Sistem harus menyediakan halaman library berisi e-book dan materi, dengan akses ditentukan oleh jenis langganan aktif pengguna | Guest, Member |
| FR-12 | Sistem harus menyediakan fitur bookmark seminar/materi bagi member | Member |
| FR-13 | Sistem harus menyediakan fitur edit profil dan informasi akun member | Member |
| FR-14 | Sistem harus menampilkan status langganan (jenis, aktif/kedaluwarsa, sisa masa berlaku) pada masing-masing kategori | Member |
| FR-15 | Sistem harus menyediakan panel admin untuk mengelola content library (upload e-book/materi, termasuk kaitan materi dengan seminar tertentu) | Admin |
| FR-16 | Sistem harus menyediakan panel admin untuk manajemen pengguna dan langganan (melihat status login, jenis langganan, aktif/kedaluwarsa) | Admin |
| FR-17 | Sistem harus menyediakan panel admin untuk mengunggah dan mengelola informasi seminar/pelatihan | Admin |
| FR-18 | Sistem harus menyediakan dashboard keuangan pada panel admin (ringkasan pendapatan, jumlah langganan aktif per kategori, riwayat pembayaran) | Admin |
| FR-19 | Sistem harus menyediakan modul artikel SEO (menulis, mempublikasikan, dan menampilkan artikel) dengan tautan promosi ke seminar terkait di bagian akhir artikel | Admin, Guest, Member |
| FR-20 | Sistem harus menampilkan tombol "Butuh Fasilitator Event? Hubungi Kami" pada halaman kemitraan yang langsung membuka WhatsApp menuju CP Tim Maternity.id (tautan wa.me dengan pesan default), tanpa formulir maupun penyimpanan data ke database | Tenaga Profesional |
| FR-21 | Sistem harus menampilkan testimoni pengguna di bagian akhir landing page dan di halaman checkout langganan, untuk meningkatkan kepercayaan calon peserta sebelum checkout | Guest, Member |
| FR-22 | Sistem harus menyediakan panel admin untuk mengelola (menambah, mengedit, menghapus, dan mengatur status tayang) konten testimoni yang ditampilkan di landing page dan halaman checkout | Admin |

### 2.3.1 Catatan Alur Langganan & Aktivasi Akses
Pengguna login menggunakan akun Google, kemudian dapat menelusuri katalog seminar menggunakan fitur filter (topik, lokasi, format, harga) maupun artikel SEO. Untuk mengakses konten berbayar, pengguna memilih salah satu dari dua kategori langganan: (1) Langganan Akses Ebook — memberi akses ke seluruh materi/e-book di website selama rentang waktu yang diajukan saat pembayaran; atau (2) Langganan Akses Seminar — memberi akses ke satu seminar tertentu beserta e-book yang terkait dengan seminar tersebut secara otomatis. Pada kedua kategori, tombol checkout mengarahkan pengguna ke WhatsApp Admin Maternity.id untuk menyelesaikan pembayaran. Setelah pembayaran dikonfirmasi, Admin akan menetapkan (setting) langganan pengguna tersebut secara manual melalui panel admin — tanpa memerlukan pengguna memasukkan kode akses apa pun. Begitu ditetapkan oleh Admin, akses e-book langsung tersedia bagi pengguna di website.

### 2.3.2 Catatan Alur Layanan Fasilitator Mitra / Tour Guide Event
Layanan ini ditujukan bagi tenaga profesional (mis. dokter atau instruktur) yang ingin mengadakan pelatihan mandiri (contoh: Pelatihan Yoga Kehamilan) dengan dukungan fasilitas dari Maternity.id sebagai penyedia Tour Guide Event. Pada halaman kemitraan, tersedia tombol "Butuh Fasilitator Event? Hubungi Kami" yang langsung membuka percakapan WhatsApp menuju CP Tim Maternity.id (tautan wa.me dengan pesan default) — tanpa formulir dan tanpa data yang disimpan di database aplikasi. Seluruh pembahasan kebutuhan (jenis pelatihan, perkiraan tanggal, jumlah peserta, kebutuhan venue/logistik/nakes pendamping) serta tindak lanjutnya dilakukan langsung melalui percakapan WhatsApp antara pemohon dan Tim Maternity.id, di luar sistem.

## 2.4 Kebutuhan Non-Fungsional (Non-Functional Requirements)
| Kategori | Kebutuhan |
|---|---|
| Usability | Antarmuka mudah digunakan oleh pengguna awam, alur pencarian dan filter katalog sederhana, desain mobile-responsive |
| Performance | Halaman katalog dan hasil filter harus dimuat dalam waktu ≤ 3 detik pada koneksi standar |
| Security | Data pribadi pengguna dienkripsi; autentikasi sepenuhnya didelegasikan ke Google OAuth 2.0 tanpa penyimpanan password internal |
| Reliability | Status langganan dan akses konten harus konsisten dengan penetapan yang dilakukan Admin, tanpa duplikasi akses |
| Availability | Target uptime layanan minimal 99% di luar jadwal pemeliharaan terjadwal |
| Scalability | Arsitektur harus mampu menampung pertumbuhan pengguna dari cakupan Solo–Jogja ke cakupan nasional |
| Compatibility | Website harus kompatibel dengan browser modern (Chrome, Safari, Edge) di perangkat desktop dan mobile |
| SEO | Halaman artikel harus mendukung praktik SEO dasar: meta title/description, URL slug yang deskriptif, sitemap.xml, dan waktu muat halaman yang cepat |
| Maintainability | Kode dan basis data terdokumentasi agar memudahkan penambahan fitur (mis. ekspansi wilayah, integrasi platform promosi lain) |

## 2.5 Daftar Use Case per Aktor
| Aktor | Use Case Utama |
|---|---|
| Guest | Melihat landing page, membaca artikel SEO, melihat katalog terbatas, login dengan Google |
| Member | Login Google, mencari dan memfilter katalog seminar, memilih kategori langganan, checkout via WhatsApp Admin, melihat e-book sesuai langganan aktif, bookmark, edit profil |
| Owner/Mitra | Mengajukan seminar, mengisi formulir kolaborasi, koordinasi via WhatsApp |
| Tenaga Profesional (Fasilitator Mitra) | Membuka halaman kemitraan, menekan tombol "Butuh Fasilitator Event? Hubungi Kami", langsung terhubung ke WhatsApp CP Tim Maternity.id |
| Admin | Mengelola content library, menetapkan langganan tiap user, mengunggah info seminar, mengelola artikel SEO, mengelola testimoni pengguna, memantau dashboard keuangan |

