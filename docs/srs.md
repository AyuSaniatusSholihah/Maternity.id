# 2. Software Requirements Specification (SRS)

## 2.1 Pendahuluan
### 2.1.1 Tujuan Dokumen
Dokumen ini menjelaskan kebutuhan fungsional dan non-fungsional untuk pengembangan website Maternity.id, sebagai acuan bagi tim pengembang, desainer, dan pemangku kepentingan dalam membangun produk.

### 2.1.2 Ruang Lingkup Produk
Maternity.id adalah aplikasi berbasis website yang memungkinkan pengguna (ibu hamil/nifas) menemukan seminar/pelatihan maternitas melalui fitur filter katalog (topik, lokasi, format, harga), login menggunakan akun Google, melengkapi data diri setelah login pertama (`/complete-profile`), serta berlangganan akses e-book (seluruh materi atau per seminar) melalui proses pembayaran manual: checkout → upload bukti transfer → verifikasi admin → akses aktif. Pengguna dapat memantau status pesanan secara real-time (`/orders/{id}`). Owner/penyelenggara seminar dapat mengajukan kolaborasi melalui fitur Ajukan Seminar (`/ajukan-seminar`). Tenaga profesional yang ingin mengadakan pelatihan mandiri dapat menghubungi CP Tim Maternity.id via tombol WhatsApp di **Section Mitra** yang tertanam di landing page. Admin mengelola konten, seminar, verifikasi pembayaran order, aktivasi langganan, keuangan, artikel SEO, dan testimoni melalui panel admin.

### 2.1.3 Definisi, Akronim, dan Singkatan
| Istilah | Definisi |
|---|---|
| SRS | Software Requirements Specification |
| Langganan Akses Ebook | Kategori langganan yang memberi akses ke seluruh materi/e-book selama rentang waktu tertentu |
| Langganan Akses Seminar | Kategori langganan untuk mengikuti satu seminar, otomatis memberi akses e-book terkait |
| Order | Transaksi pemesanan yang dibuat user saat checkout; menyimpan bukti bayar dan status verifikasi |
| is_profile_complete | Flag boolean di tabel `member` yang menandai apakah user telah mengisi data diri wajib (No. HP, alamat) |
| Complete Profile | Halaman `/complete-profile` yang wajib diisi user setelah login pertama sebelum dapat checkout |
| Owner/Mitra | Pihak penyelenggara seminar/pelatihan yang mendaftarkan kegiatannya di platform |
| Member | Pengguna yang telah login dengan Google dan profil data dirinya sudah lengkap |
| Guest | Pengunjung website yang belum login |
| Google OAuth | Metode autentikasi tunggal menggunakan akun Google |
| Section Mitra | Bagian tertanam di halaman utama (landing page) berisi info program kemitraan & tombol WA Fasilitator |
| Fasilitator Mitra / Tour Guide Event | Layanan Maternity.id membantu tenaga profesional menyelenggarakan pelatihan mandiri |
| Testimoni | Ulasan member dikurasi admin, tampil di landing page dan halaman checkout |

---

## 2.2 Deskripsi Umum
### 2.2.1 Perspektif Produk
Maternity.id merupakan produk baru (greenfield), berupa aplikasi web responsif yang terintegrasi dengan kanal promosi TikTok, autentikasi Google OAuth, proses pembayaran manual (upload bukti transfer + verifikasi admin), kanal pengiriman akses via WhatsApp setelah order disetujui, dan modul artikel SEO untuk akuisisi pengguna organik.

### 2.2.2 Karakteristik Pengguna / Aktor
| Aktor | Deskripsi |
|---|---|
| Guest | Pengunjung yang mengakses landing page, katalog terbatas, dan artikel SEO tanpa login |
| Member | Pengguna dengan akun Google dan profil data diri lengkap (`is_profile_complete = true`), minimal satu langganan aktif |
| Owner/Mitra Seminar | Penyelenggara seminar yang mengajukan kolaborasi melalui `/ajukan-seminar` |
| Tenaga Profesional (Fasilitator Mitra) | Dokter/instruktur yang menghubungi Tim Maternity.id via tombol WA di Section Mitra |
| Admin | Pengelola internal: memverifikasi order pembayaran, mengatur hak akses, mengelola konten |

### 2.2.3 Batasan (Constraints)
- Tahap awal melayani wilayah Solo dan Jogja.
- Login hanya melalui Google OAuth; tidak ada login email/password maupun lupa password.
- Checkout dilakukan di dalam website (form upload bukti transfer), bukan langsung ke WA. WhatsApp digunakan untuk pengiriman link akses setelah order disetujui admin.
- Verifikasi pembayaran dilakukan manual oleh Admin melalui panel `admin/orders`.
- Notifikasi utama ke user adalah via email (`OrderReceivedMail`) dan status real-time di `/orders/{id}`.
- Aplikasi versi awal berbasis website (belum mobile-native).
- Section Mitra adalah bagian dari landing page, bukan halaman terpisah. Ajukan Seminar adalah halaman terpisah (`/ajukan-seminar`).

### 2.2.4 Asumsi dan Ketergantungan
- Tersedia integrasi Google OAuth 2.0 untuk proses login.
- Tersedia konfigurasi Laravel Mail (SMTP) untuk pengiriman `OrderReceivedMail`.
- Tersedia nomor WhatsApp Admin resmi untuk pengiriman link akses pasca-verifikasi.
- Tersedia akun bisnis TikTok resmi Maternity.id.
- Pengguna memiliki akses internet dan perangkat yang mendukung browser modern.

---

## 2.3 Kebutuhan Fungsional (Functional Requirements)

| ID | Kebutuhan Fungsional | Aktor Terkait |
|---|---|---|
| FR-01 | Sistem harus menampilkan landing page berisi informasi umum, seminar unggulan (upcoming event), artikel SEO terbaru, testimoni, dan **Section Mitra** (info program kemitraan + tombol WA Fasilitator). Section Mitra merupakan bagian dari landing page, bukan halaman terpisah. | Guest |
| FR-02 | Sistem harus menyediakan navigasi atas (top navbar) berisi tautan cepat ke Info Seminar, Library, dan Artikel | Guest, Member |
| FR-03 | Sistem harus mendukung login menggunakan Google OAuth. Setelah login pertama kali, sistem mengecek `is_profile_complete` pada tabel `member`. Jika `false`, user **wajib diarahkan ke `/complete-profile`** untuk mengisi data diri (No. HP, Alamat, dsb.) sebelum dapat melanjutkan ke checkout. | Guest, Member |
| FR-04 | Sistem harus menyediakan fitur filter katalog berdasarkan topik, lokasi, format, dan harga | Guest, Member |
| FR-05 | Sistem harus menyediakan dua kategori langganan: (a) Akses Ebook — semua materi, berbatas waktu; (b) Akses Seminar — satu seminar + e-book terkait otomatis | Member |
| FR-06 | Sistem harus menyediakan halaman pembayaran (`/checkout/{order}/payment`) berisi: informasi rekening bank tujuan transfer, nominal pembayaran, batas waktu pembayaran, dan **form upload bukti pembayaran** (screenshot transfer). Setelah disubmit, sistem mengirim email konfirmasi `OrderReceivedMail` ke member dan notifikasi badge ke Admin. | Member |
| FR-07 | Sistem harus otomatis memberikan akses e-book terkait kepada member dengan Langganan Akses Seminar, via relasi `workshop_material`. | Member |
| FR-08 | Sistem harus menyediakan halaman **Status Pesanan** (`/orders/{id}`) yang menampilkan status order real-time: `menunggu_pembayaran` / `menunggu_verifikasi` / `diverifikasi` / `ditolak` / `selesai`. Jika ditolak, alasan penolakan ditampilkan dan member dapat mengunggah ulang bukti pembayaran. | Member |
| FR-09 | Sistem harus menyediakan panel admin `admin/orders` untuk: melihat daftar order masuk, melihat detail bukti pembayaran, menekan **Approve** (ubah status, lampirkan akses, generate link WA pengiriman akses) atau **Reject** (isi alasan penolakan, ubah status menjadi `ditolak`). | Admin |
| FR-10 | Sistem harus menyediakan halaman `/ajukan-seminar` untuk pengajuan kolaborasi seminar (media partner), yang mengarahkan pengguna ke WhatsApp Admin. | Owner/Mitra |
| FR-11 | Sistem harus menyediakan halaman library berisi e-book dan materi, dengan akses ditentukan oleh jenis langganan aktif | Guest (locked view), Member |
| FR-12 | Sistem harus menyediakan fitur bookmark seminar/materi bagi member | Member |
| FR-13 | Sistem harus menyediakan fitur edit profil dan informasi akun member di `/profile` | Member |
| FR-14 | Sistem harus menampilkan status langganan (jenis, aktif/kedaluwarsa, sisa masa berlaku) di `/my-subscriptions` | Member |
| FR-15 | Sistem harus menyediakan panel admin untuk mengelola content library (upload e-book, kaitan ke seminar) | Admin |
| FR-16 | Sistem harus menyediakan panel admin untuk manajemen member dan langganan aktif | Admin |
| FR-17 | Sistem harus menyediakan panel admin untuk mengelola informasi seminar | Admin |
| FR-18 | Sistem harus menyediakan **dashboard keuangan** pada panel admin, mengambil data agregat dari tabel `orders` (total nominal, jumlah per status, riwayat verifikasi) dan tabel `membership`/`workshop_booking`. | Admin |
| FR-19 | Sistem harus menyediakan modul artikel SEO (menulis, mempublikasikan, menampilkan) dengan CTA promosi seminar terkait di akhir artikel | Admin, Guest, Member |
| FR-20 | Sistem harus menampilkan **Section Mitra** di dalam landing page, berisi tombol "Butuh Fasilitator Event? Hubungi Kami" yang langsung membuka WhatsApp CP Tim Maternity.id (tautan `wa.me` dengan pesan default), tanpa formulir dan tanpa penyimpanan data ke database. | Tenaga Profesional |
| FR-21 | Sistem harus menampilkan testimoni member di landing page dan halaman checkout | Guest, Member |
| FR-22 | Sistem harus menyediakan panel admin untuk mengelola konten testimoni (tambah, edit, hapus, toggle status tayang) | Admin |

---

### 2.3.1 Catatan Alur Lengkapi Data Diri (Complete Profile)
Setelah login Google berhasil, sistem mengecek `member.is_profile_complete`:
- Jika `false` (belum pernah mengisi data diri) → redirect ke `/complete-profile`. User mengisi No. HP, Alamat, dan data relevan lain. Setelah submit, `is_profile_complete` diset `true`.
- Jika `true` → redirect ke tujuan semula (checkout, katalog, dsb.).
- Pengecekan ini **hanya muncul sekali** — jika sudah `true`, tidak pernah redirect lagi ke complete-profile.

### 2.3.2 Catatan Alur Order & Pembayaran Manual
1. Member memilih paket di `/checkout` → sistem membuat record `orders` dengan status `menunggu_pembayaran`.
2. Member diarahkan ke `/checkout/{order}/payment` → halaman menampilkan info rekening, nominal, dan form upload bukti bayar.
3. Member upload screenshot transfer dan submit → status order berubah ke `menunggu_verifikasi`.
4. Sistem mengirim `OrderReceivedMail` (Laravel Mailable) ke email member dan menambah badge notifikasi di panel admin.
5. Admin membuka `admin/orders`, melihat detail, lalu menekan **Approve** atau **Reject**.
6. **Approve** → status `diverifikasi` → sistem otomatis membuat/mengaktifkan `membership` atau `workshop_booking` → admin dapat mengirim link akses via `wa.me` prefilled link → status diperbarui ke `selesai`.
7. **Reject** → status `ditolak` → alasan penolakan tersimpan di `orders.rejection_reason` → member dapat melihat alasan di `/orders/{id}` dan mengunggah ulang bukti.

### 2.3.3 Catatan Alur Layanan Fasilitator Mitra / Tour Guide Event
Pada **Section Mitra** yang tertanam di landing page, tersedia tombol "Butuh Fasilitator Event? Hubungi Kami" yang langsung membuka percakapan WhatsApp ke CP Tim Maternity.id — tanpa formulir dan tanpa penyimpanan data di database.

---

## 2.4 Kebutuhan Non-Fungsional (Non-Functional Requirements)
| Kategori | Kebutuhan |
|---|---|
| Usability | Antarmuka mudah digunakan, alur complete-profile → checkout → status order harus intuitif, desain mobile-responsive |
| Performance | Halaman katalog, filter, dan status order dimuat ≤ 3 detik pada koneksi standar |
| Security | Data pribadi dienkripsi; autentikasi didelegasikan ke Google OAuth; file bukti pembayaran hanya dapat diakses oleh member pemilik order dan admin |
| Reliability | Status order dan hak akses konsisten dengan tindakan admin di panel; tidak ada duplikasi akses |
| Availability | Target uptime minimal 99% di luar pemeliharaan terjadwal |
| Scalability | Arsitektur mampu menampung pertumbuhan dari wilayah Solo–Jogja ke nasional |
| Compatibility | Kompatibel dengan browser modern (Chrome, Safari, Edge) di desktop dan mobile |
| SEO | Halaman artikel mendukung meta title/description, slug deskriptif, OG image, dan sitemap.xml |
| Maintainability | Kode terdokumentasi; mudah diperluas (ekspansi wilayah, integrasi payment gateway ke depan) |

---

## 2.5 Daftar Use Case per Aktor
| Aktor | Use Case Utama |
|---|---|
| Guest | Melihat landing page (termasuk Section Mitra), membaca artikel SEO, melihat katalog terbatas, login dengan Google |
| Member | Login Google, lengkapi data diri (jika belum), filter katalog, pilih paket, checkout & upload bukti bayar, pantau status order, akses library sesuai langganan, bookmark, edit profil |
| Owner/Mitra | Mengajukan seminar via `/ajukan-seminar` (diarahkan ke WA Admin) |
| Tenaga Profesional | Menekan tombol WA Fasilitator di Section Mitra pada landing page |
| Admin | Verifikasi order pembayaran (approve/reject), aktivasi akses member, kelola konten seminar/materi/artikel, kelola testimoni, pantau dashboard keuangan |
