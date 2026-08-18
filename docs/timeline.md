# Timeline Sprint Maternity.id — REVISI (Alur Login & Pembayaran Manual)
> Deadline: **31 Juli 2026** | Durasi: **9 Hari (23–31 Juli)** | Database: MySQL | Stack: Laravel 11 + Blade
> Dokumen ini merevisi alur **login** dan **checkout/pembayaran** sesuai flowchart terbaru, serta menambahkan tracker progress **per halaman**.

---

## 🔄 Apa yang Berubah dari Timeline Sebelumnya

Timeline lama menganggap checkout = klik tombol → langsung buka WA. Berdasarkan alur terbaru, proses pembayaran membutuhkan verifikasi manual dari admin:

| Sebelumnya (Lama) | Sekarang (Sesuai Flowchart Terbaru) |
|---|---|
| Cek login → langsung checkout | Cek login → **jika belum login, redirect ke login Google → setelah berhasil, isi/lengkapi data diri (`/complete-profile`) jika data belum lengkap → baru lanjut ke checkout** |
| Checkout → klik tombol → buka WA (link `wa.me`) | Checkout → **halaman pembayaran (instruksi transfer & rekening) → upload bukti pembayaran (screenshot) → submit → sistem kirim email konfirmasi ke user (`OrderReceivedMail`) + notifikasi badge ke admin → admin verifikasi manual (`admin/orders`) → sistem kirim akses produk via web & WA → admin update status "selesai"** |
| Tidak ada status pesanan | Perlu status pesanan real-time: `menunggu_pembayaran` → `menunggu_verifikasi` → `diverifikasi` / `ditolak` → `selesai` |
| Halaman Mitra berdiri sendiri (`/mitra`) | Section Mitra **di dalam landing page (`home.blade.php`)**, sedangkan `/ajukan-seminar` tetap halaman terpisah untuk pengajuan kolaborasi media partner |

### Konsekuensi Teknis & Arsitektur
- **Tabel baru `orders`**: Menyimpan bukti pembayaran (`payment_proof`), nominal (`amount`), dan status pesanan (`status`).
- **Field baru di `member`**: `phone_number`, `address`, dan `is_profile_complete` (boolean) untuk gatekeeping alur sebelum checkout.
- **Halaman Baru User**: `/complete-profile` (Lengkapi Data Diri), `/checkout/{order}/payment` (Pembayaran & Upload Bukti), `/orders/{id}` (Status Pesanan Real-time).
- **Halaman Baru Admin**: `admin/orders` (Verifikasi Pembayaran: lihat bukti bayar, tombol Approve/Reject).
- **Notifikasi & Mailable**: Class Mailable `OrderReceivedMail` untuk konfirmasi ke user + notifikasi in-app badge count di sidebar admin. WA digunakan pada tahap *pengiriman link akses* setelah disetujui admin.

---

## 🧭 Alur End-to-End Ringkas

1. **Guest Browsing**
   - User jelajahi katalog seminar / library / artikel sebagai guest.
   - User memilih seminar atau paket langganan.

2. **Login & Lengkapi Data Diri**
   - Belum login → Redirect ke Google OAuth.
   - Setelah login, sistem mengecek `is_profile_complete`:
     - Jika `false` → Redirect ke `/complete-profile` (isi No. HP, Alamat, dll). Setelah diisi, set `is_profile_complete = true`.
     - Jika `true` → Lanjut ke halaman checkout.

3. **Checkout & Pembayaran Manual**
   - User membuka `/checkout`, memilih paket/seminar → Sistem membuat record `Order` dengan status `menunggu_pembayaran`.
   - User diarahkan ke `/checkout/{order}/payment` (tampil info rekening bank, nominal transfer, batas waktu, dan form upload bukti bayar).
   - User upload screenshot bukti transfer dan klik Kirim.
   - Status order berubah menjadi `menunggu_verifikasi`.
   - Sistem mengirim email konfirmasi `OrderReceivedMail` ke user & notifikasi badge order masuk ke Admin.

4. **Verifikasi Admin & Pengiriman Akses**
   - Admin mengecek list order di `admin/orders`, melihat bukti bayar, lalu memilih **Approve** atau **Reject**.
   - **Jika Approve**:
     - Status order berubah menjadi `diverifikasi`.
     - Sistem otomatis melampirkan hak akses ke user (`membership` atau `workshop_booking`).
     - Tautan akses produk dikirimkan via WA (`wa.me` prefilled link) dan tampil di `/library` atau `/my-subscriptions`.
     - Admin memperbarui status order menjadi `selesai`.
   - **Jika Reject**:
     - Status order berubah menjadi `ditolak` beserta catatan alasan penolakan.
     - User dapat melihat alasan dan mengunggah ulang bukti pembayaran di `/orders/{id}`.

---

## 📅 Rencana Kerja Harian (Skenario Terintegrasi)

### Hari 1 — Kamis, 24 Juli: Setup & Foundation
**Bersama (Pagi):**
- Repo GitHub, setup Laravel 11, install `laravel/socialite`, Tailwind CSS, Alpine.js.
- Jalankan migration awal + tabel `orders` baru. Setup Google Cloud Console OAuth credentials.

**Nia:**
- Layout utama `layouts/app.blade.php` (Navbar, Footer, Design Tokens).
- Component Blade `<x-navbar>`, `<x-footer>`, `<x-card-seminar>`, `<x-card-ebook>`.
- Landing page skeleton (`pages/home.blade.php`).

**Rafi:**
- Migration lengkap (termasuk `orders` & update `member`).
- Model & Eloquent Relationships. Seeder data dummy.
- Setup Google OAuth (`AuthController`), middleware `IsAdmin`, layout admin `layouts/admin.blade.php`.

---

### Hari 2 — Jumat, 25 Juli: Auth, Complete Profile & Landing Page
**Nia:**
- Landing Page lengkap (`home.blade.php`) beserta **Section Mitra** (info kemitraan + tombol WA Fasilitator).
- UI navbar dengan avatar & menu profil/langganan.
- UI redirect ke `/complete-profile` jika `is_profile_complete == false`.

**Rafi:**
- `AuthController` callback Google: cek `is_profile_complete`, buat sesi, atur redirect logis.
- `HomeController@index` (seminar upcoming, artikel terbaru, testimoni).
- Login Admin & `Admin\DashboardController@index`.

---

### Hari 3 — Sabtu, 26 Juli: Katalog Seminar & Filter
**Nia:**
- Halaman katalog `/seminars` dengan filter Alpine.js (topik, lokasi, format, harga).
- Detail seminar `/seminars/{slug}` dengan tombol daftar/langganan yang mengarah ke `/checkout`.

**Rafi:**
- `WorkshopController@index` & `@show` dengan query filter.
- Admin CRUD Workshop (`Admin\WorkshopController`).

---

### Hari 4 — Minggu, 27 Juli: Complete Profile, Checkout, Pembayaran & Admin Orders
**Nia:**
- Halaman `/complete-profile` — form data diri (No. HP, Alamat, Tanggal Lahir/HPL) + validasi.
- Halaman `/checkout` — pilih paket langganan / seminar.
- Halaman `/checkout/{order}/payment` — instruksi rekening + form upload bukti bayar (input file + preview image).
- Halaman `/orders/{id}` — status order real-time.

**Rafi:**
- Migration & Model `Order` (polymorphic relation to `membership`/`workshop_booking`).
- `OrderController@store`, `@uploadProof`, `@show`.
- Class Mailable `OrderReceivedMail` ke user & notifikasi badge count di `admin/orders`.
- **Admin Order Controller (`Admin\OrderController`)**: index (list pending), show (detail bukti bayar), approve (attach akses + generate link WA), reject (input alasan).

---

### Hari 5 — Senin, 28 Juli: Library, Profil & Artikel SEO
**Nia:**
- Halaman `/library` & `/library/{slug}` — state locked vs unlocked berbasis `isAccessibleBy()`.
- Halaman `/profile` & `/my-subscriptions` — status langganan aktif & sisa hari.
- Halaman `/articles` & `/articles/{slug}` — artikel SEO + CTA seminar.

**Rafi:**
- `MaterialController` & access checker helper di model `Material`.
- `ProfileController` & `SubscriptionController`.
- `ArticleController` & Admin CRUD Artikel (`Admin\ArticleController`).

---

### Hari 6 — Selasa, 29 Juli: Testimoni, Ajukan Seminar & Admin Finance
**Nia:**
- Testimoni di landing page & checkout.
- Halaman `/ajukan-seminar` (form pengajuan media partner / kolaborasi seminar).
- Mobile responsiveness review (375px viewport).

**Rafi:**
- Admin CRUD Testimoni (`Admin\TestimonialController`).
- Admin Finance Dashboard (`Admin\FinanceController@index`) — mengambil data dari agregasi tabel `orders` (pendapatan, status order).

---

### Hari 7 — Rabu, 30 Juli: QA Integration, Reject Flow & Staging Deploy
**Nia:**
- View QA: test alur belum login → login → `/complete-profile` → `/checkout` → upload bukti → status order.
- Error pages (`404.blade.php`, `403.blade.php`).

**Rafi:**
- Validasi `FormRequest` semua endpoint.
- Handling flow reject: user dapat re-upload bukti pembayaran jika order status = `ditolak`.
- Deploy ke staging environment (Railway/VPS), `php artisan storage:link`, migrate & seed.

---

### Hari 8 — Kamis, 31 Juli: Final Polish & Launch 🚀
**Nia & Rafi:**
- Final test production URL (desktop & mobile).
- Route caching, config caching, SEO tag verification.
- `README.md` documentation, database backup, & system walkthrough demo.

---

## ✅ Progress Tracker per Halaman

Status: `☐ Belum` / `🔧 On progress` / `✅ Selesai`

### Nia — Halaman User-Facing

| No | Halaman | Route | Hari Target | Status | Catatan |
|---|---|---|---|---|---|
| 1 | Layout Utama (Navbar, Footer) | `layouts/app.blade.php` | H1 | ☐ Belum | Design system dasar |
| 2 | Landing Page | `/` | H2 | ☐ Belum | Hero, upcoming, artikel, testimoni |
| 3 | Katalog Seminar + Filter | `/seminars` | H3 | ☐ Belum | Filter Alpine.js |
| 4 | Detail Seminar | `/seminars/{slug}` | H3 | ☐ Belum | Detail & CTA Checkout |
| 5 | Library Ebook | `/library` | H5 | ☐ Belum | Locked/Unlocked state |
| 6 | Detail Ebook | `/library/{slug}` | H5 | ☐ Belum | Viewer / download link |
| 7 | **Lengkapi Data Diri** | `/complete-profile` | H4 | ☐ Belum | Wajib sebelum checkout |
| 8 | Checkout (Pilih Paket) | `/checkout` | H4 | ☐ Belum | Form pembuatan order |
| 9 | **Pembayaran + Upload Bukti** | `/checkout/{order}/payment` | H4 | ☐ Belum | Info transfer & input file bukti |
| 10 | **Status Pesanan** | `/orders/{id}` | H4 | ☐ Belum | Tampilan status order real-time |
| 11 | Bookmark Saya | `/bookmarks` | H5 | ☐ Belum | List seminar/materi favorit |
| 12 | Profil Saya | `/profile` | H5 | ☐ Belum | Edit nama & data diri |
| 13 | Status Langganan | `/my-subscriptions` | H5 | ☐ Belum | Masa berlaku langganan aktif |
| 14 | List Artikel SEO | `/articles` | H5 | ☐ Belum | Katalog artikel edukasi |
| 15 | Detail Artikel SEO | `/articles/{slug}` | H5 | ☐ Belum | Konten artikel + CTA seminar |
| 16 | Testimoni (Embedded) | embedded | H6 | ☐ Belum | Landing page & checkout modal |
| 17 | Section Mitra (Embedded) | `/` (section `home.blade.php`) | H2 | ☐ Belum | Info kemitraan + tombol WA Fasilitator |
| 18 | Ajukan Seminar | `/ajukan-seminar` | H6 | ☐ Belum | Form pengajuan media partner |
| 19 | Error Pages (404/403) | — | H7 | ☐ Belum | Custom Blade error views |
| 20 | QA Responsif Semua Halaman | — | H7 | ☐ Belum | Breakpoints: 375px, 768px, 1280px |

---

### Rafi — Backend & Admin Panel

| No | Halaman/Modul | Route | Hari Target | Status | Catatan |
|---|---|---|---|---|---|
| 1 | Migration + Model (termasuk `orders`) | — | H1 | ☐ Belum | MySQL schema setup |
| 2 | Auth Google (Redirect & Callback) | `/auth/google*` | H1–H2 | ☐ Belum | Gatekeeping `is_profile_complete` |
| 3 | Admin Layout & Middleware `IsAdmin` | — | H1 | ☐ Belum | Proteksi route `/admin/*` |
| 4 | HomeController | `/` | H2 | ☐ Belum | Agregasi data landing page |
| 5 | Admin Dashboard | `admin/dashboard` | H2 | ☐ Belum | Ringkasan umum admin |
| 6 | WorkshopController (Filter Query) | `/seminars*` | H3 | ☐ Belum | Filtering logic backend |
| 7 | Admin CRUD Workshop | `admin/workshops` | H3 | ☐ Belum | Kelola seminar |
| 8 | MaterialController (Access Checker) | `/library*` | H5 | ☐ Belum | Logic `isAccessibleBy()` |
| 9 | Admin CRUD Material | `admin/materials` | H5 | ☐ Belum | Upload ebook & mapping workshop |
| 10 | **OrderController** | `/checkout*`, `/orders/*` | H4 | ☐ Belum | Store, upload proof, show status |
| 11 | **Mailable `OrderReceivedMail`** | — | H4 | ☐ Belum | Email konfirmasi bukti diterima |
| 12 | **Admin: Verifikasi Pembayaran** | `admin/orders` | H4 | ☐ Belum | List, show proof, approve/reject |
| 13 | Admin CRUD Membership & Booking | `admin/memberships`, `admin/bookings` | H4 | ☐ Belum | Pengaturan langganan manual |
| 14 | ProfileController & SubscriptionController | `/profile`, `/my-subscriptions` | H5 | ☐ Belum | Kelola profil & langganan member |
| 15 | ArticleController & Admin CRUD Artikel | `/articles*`, `admin/articles` | H5 | ☐ Belum | Rich text, SEO meta, publish status |
| 16 | Admin CRUD Testimoni | `admin/testimonials` | H6 | ☐ Belum | Kelola testimoni & status tayang |
| 17 | Admin Finance Dashboard | `admin/finance` | H6 | ☐ Belum | Ringkasan dari tabel `orders` |
| 18 | FormRequest Validation | — | H7 | ☐ Belum | Validasi input semua form |
| 19 | Deploy Staging Environment | — | H7 | ☐ Belum | Production-ready setup |
| 20 | Deploy Production + Backup | — | H8 | ☐ Belum | Route/config cache & DB backup |

---

## ⚠️ Analisis Risiko & Mitigasi Alur Pembayaran Manual

| Risiko | Mitigasi |
|---|---|
| Verifikasi admin lambat → user menunggu lama | Tampilkan estimasi waktu verifikasi di `/orders/{id}` (mis. "Maksimal 1x24 jam") |
| User mengunggah gambar bukti yang salah/blur | Validasi file upload (image max 2MB), admin dapat melakukan **Reject** dengan alasan jelas, dan user dapat mengunggah ulang di `/orders/{id}` |
| Pembelian menggantung di `menunggu_pembayaran` | Sediakan otomatis expired timestamp pada order (misal 24 jam) agar order tidak menumpuk |
| Fitur "Lengkapi Data Diri" mengganggu alur login | Hanya dimunculkan **satu kali** ketika `is_profile_complete == false`, diset `true` setelah form disubmit |
