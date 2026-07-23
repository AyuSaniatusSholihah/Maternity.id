# Timeline Sprint Maternity.id
> Deadline: **31 Juli 2026** | Durasi: **9 Hari (23–31 Juli)** | Database: MySQL | Stack: Laravel 11 + Blade

Masing-masing orang pegang fitur **end-to-end** (Blade View + Controller + Model sekaligus).

---

## Pembagian Peran

| | **Nia** | **Rafi** |
|---|---|---|
| **Domain** | Guest Experience + Member Journey | Admin Panel + Backend Logic |
| **Tanggung Jawab** | Blade views user-facing + Controller + Route | Migration, Model, Controller admin + logika bisnis |

> Satu project Laravel. Nia pegang folder `resources/views/` bagian user, Rafi pegang `resources/views/admin/`. Controller, Model, dan Route dibagi sesuai domain masing-masing.

---

## Tech Stack

| Layer | Teknologi |
|---|---|
| Frontend | Laravel Blade (SSR) |
| Interaktivitas | Alpine.js + CSS (animasi, toggle, filter) |
| Backend | Laravel 11 |
| Auth | Google OAuth 2.0 (Laravel Socialite) |
| Database | MySQL |
| Styling | Tailwind CSS |
| Deploy | Railway / VPS (satu server, full Laravel) |

---

## Struktur Folder Kerja

```
resources/views/
├── layouts/
│   ├── app.blade.php        ← Nia
│   └── admin.blade.php      ← Rafi
├── components/              ← Nia
├── pages/                   ← Nia (semua halaman user)
│   ├── home.blade.php
│   ├── seminars/
│   ├── library/
│   ├── articles/
│   ├── profile.blade.php
│   └── ...
└── admin/                   ← Rafi (semua halaman admin)
    ├── dashboard.blade.php
    ├── workshops/
    ├── materials/
    ├── articles/
    ├── testimonials/
    ├── memberships/
    └── ...

app/Http/Controllers/
├── Auth/                    ← Rafi
├── WorkshopController.php   ← Nia (user view) + Rafi (admin)
├── MaterialController.php   ← Nia (user view) + Rafi (admin)
├── ArticleController.php    ← Nia (user view) + Rafi (admin)
└── Admin/                   ← Rafi
```

---

## Hari 1 — Kamis, 24 Juli: Setup & Foundation

> ⚠️ Wajib kerjain bareng di awal hari ini dulu sebelum pecah tugas!

### Bersama (pagi, ~2 jam)
- [ ] Buat repo GitHub (1 repo Laravel)
- [ ] Inisialisasi project Laravel 11 (`laravel new maternity-id`)
- [ ] Install package: `laravel/socialite`, `laravel-lang`, Tailwind CSS, Alpine.js
- [ ] Buat semua migration sesuai ERD
- [ ] Setup Google OAuth credentials di Google Cloud Console
- [ ] Bagi branch: `feat/nia-*` untuk Nia, `feat/rafi-*` untuk Rafi

### Nia
- [ ] Buat layout utama: `layouts/app.blade.php` (Navbar, Footer, warna brand, font)
- [ ] Buat komponen Blade: `<x-navbar>`, `<x-footer>`, `<x-card-seminar>`, `<x-card-ebook>`
- [ ] Halaman Landing Page skeleton (`pages/home.blade.php`) — hero, placeholder section
- [ ] Setup route user di `routes/web.php`: `/`, `/seminars`, `/library`, `/articles`, `/profile`

### Rafi
- [ ] Jalankan semua migration (`account`, `user_session`, `member`, `admin`, `material`, `workshop`, `workshop_material`, `article`, `testimonial`, `bookmark`, `membership`, `workshop_booking`)
- [ ] Buat semua Model + relasi Eloquent
- [ ] Seeder data dummy (5 workshop, 3 material, 3 article, 3 testimonial, 1 admin)
- [ ] Setup Google OAuth: `AuthController` dengan method `redirectToGoogle` & `handleGoogleCallback`
- [ ] Route auth: `GET /auth/google`, `GET /auth/google/callback`
- [ ] Setup session auth (Laravel session, bukan token — karena Blade SSR)
- [ ] Buat layout admin: `layouts/admin.blade.php` + middleware `IsAdmin`

---

## Hari 2 — Jumat, 25 Juli: Auth + Landing Page

### Nia — FR-01, FR-02, FR-03
- [ ] **Landing Page lengkap** (`home.blade.php`): Hero, Seminar Unggulan (dari controller), Artikel terbaru, Testimoni, CTA langganan
- [ ] **Navbar** (`x-navbar`): Logo, link (Info Seminar, Ebook, Artikel), tombol Login Google, avatar jika sudah login
- [ ] **Halaman setelah login**: redirect ke `/dashboard` atau `/seminars`
- [ ] Pasang `@auth` / `@guest` directive di Blade untuk kondisi login
- [ ] Tampilkan flash message sukses setelah login

### Rafi — FR-03 + Controller Landing
- [ ] `AuthController@redirectToGoogle` & `handleGoogleCallback` — simpan ke `account`, buat sesi, redirect
- [ ] `HomeController@index` — ambil: 3 workshop upcoming, 3 artikel published, testimoni landing
- [ ] Route: `GET /` → `HomeController@index`
- [ ] Halaman login admin + middleware `IsAdmin` untuk proteksi route `/admin/*`
- [ ] `Admin\DashboardController@index` — halaman dashboard admin

---

## Hari 3 — Sabtu, 26 Juli: Katalog Seminar + Filter

### Nia — FR-04, US-02, US-03, US-04
- [ ] **Halaman `/seminars`** (`seminars/index.blade.php`): Grid card seminar dengan loading state
- [ ] **Filter UI** menggunakan Alpine.js + form GET: Topik, Lokasi, Format, Harga (query param `?topic=&format=&price_max=`)
- [ ] **Halaman `/seminars/{slug}`** (`seminars/show.blade.php`): Detail seminar (nama, deskripsi, tanggal, lokasi, harga, tombol daftar)
- [ ] Tampilkan "Tidak ada seminar" jika hasil filter kosong
- [ ] Tombol "Daftar / Langganan Seminar" → arahkan ke `/subscribe?workshop={slug}`

### Rafi — FR-04, FR-17 + Admin Workshop
- [ ] `WorkshopController@index` — filter query: `topic`, `location`, `format`, `price_min`, `price_max`
- [ ] `WorkshopController@show` — detail workshop by slug
- [ ] Route: `GET /seminars`, `GET /seminars/{slug}`
- [ ] **Admin: `Admin\WorkshopController`** — CRUD (index, create, store, edit, update, destroy)
- [ ] Blade admin: `admin/workshops/index.blade.php`, `create.blade.php`, `edit.blade.php`
- [ ] Slug auto-generate dari name (gunakan `Str::slug()`)

---

## Hari 4 — Minggu, 27 Juli: Library Ebook + Langganan + Bookmark

### Nia — FR-05, FR-06, FR-07, FR-11, FR-12
- [ ] **Halaman `/library`** (`library/index.blade.php`): Grid ebook, state locked vs unlocked pakai `@if ($material->isAccessibleBy(auth()->user()))`
- [ ] **Halaman `/library/{slug}`** (`library/show.blade.php`): Detail ebook — tombol baca jika punya akses, tampilkan locked state jika tidak
- [ ] **Halaman `/subscribe`** (`subscribe/index.blade.php`): Pilih tipe langganan + tampilkan testimoni checkout
- [ ] **Tombol Checkout**: link `wa.me` dengan pesan otomatis berisi nama user + paket yang dipilih (FR-06)
- [ ] **Fitur Bookmark**: form POST toggle bookmark + halaman `/bookmarks`

### Rafi — FR-09, FR-15, FR-16 + Admin Ebook & Langganan
- [ ] `MaterialController@index` & `@show` — cek akses via `membership` atau `workshop_booking` + `workshop_material`
- [ ] Method helper `isAccessibleBy(User $user)` di Model `Material`
- [ ] `BookmarkController@toggle` (POST) & `@index` (GET)
- [ ] **Admin: `Admin\MaterialController`** — CRUD ebook + attach/detach ke workshop
- [ ] **Admin: `Admin\MembershipController`** — set langganan user (pilih member, pilih tipe, set tanggal)
- [ ] **Admin: `Admin\WorkshopBookingController`** — set booking user ke workshop
- [ ] **Admin: `Admin\MemberController@index`** — daftar member + status langganan

---

## Hari 5 — Senin, 28 Juli: Profil + Status Langganan + Artikel SEO

### Nia — FR-13, FR-14, FR-19
- [ ] **Halaman `/profile`** (`profile/edit.blade.php`): Form edit nama, update via POST + flash message sukses
- [ ] **Halaman `/my-subscriptions`** (`profile/subscriptions.blade.php`): Status tiap langganan (jenis, aktif/expired, sisa hari pakai `Carbon::diffInDays()`)
- [ ] **Halaman `/articles`** (`articles/index.blade.php`): List artikel SEO (card, thumbnail, cuplikan)
- [ ] **Halaman `/articles/{slug}`** (`articles/show.blade.php`): Konten artikel + CTA seminar terkait di bawah
- [ ] SEO per halaman: `<title>`, `<meta name="description">`, Open Graph tag di Blade layout

### Rafi — FR-13, FR-14, FR-19 + Admin Artikel
- [ ] `ProfileController@edit` & `@update` — update data member
- [ ] `SubscriptionController@index` — ambil membership & workshop_booking aktif milik user
- [ ] `ArticleController@index` & `@show` — list & detail artikel published
- [ ] **Admin: `Admin\ArticleController`** — CRUD artikel (dengan rich text editor, slug, meta SEO, seminar terkait, status publish)
- [ ] Pastikan `published_at` diisi saat status diubah ke `published`

---

## Hari 6 — Selasa, 29 Juli: Testimoni + Halaman Mitra + Admin Keuangan

### Nia — FR-21, FR-10, FR-20
- [ ] **Testimoni di halaman checkout** (`/subscribe`) — tampilkan yang `display_location = checkout` atau `both`
- [ ] Pastikan testimoni landing (`display_location = landing` atau `both`) tampil di `home.blade.php`
- [ ] **Halaman `/mitra`** (`mitra/index.blade.php`): Info program kemitraan + tombol WA Fasilitator (direct `wa.me` link, FR-20)
- [ ] **Halaman `/ajukan-seminar`** (`mitra/ajukan.blade.php`): Deskripsi singkat + tombol redirect WA Admin (FR-10)
- [ ] Mobile responsiveness review — cek semua halaman di viewport 375px

### Rafi — FR-18, FR-22 + Admin Testimoni & Dashboard Keuangan
- [ ] **Admin: `Admin\TestimonialController`** — CRUD (nama, foto, isi, role, display_location, status, sort_order)
- [ ] Blade admin: `admin/testimonials/index.blade.php`, `create.blade.php`, `edit.blade.php`
- [ ] **Admin: `Admin\FinanceController@index`** — ringkasan: total pendapatan, jumlah langganan aktif per tipe, tabel riwayat
- [ ] Query dashboard: `Membership::sum('amount_paid')`, `WorkshopBooking::sum('amount_paid')`, count aktif

---

## Hari 7 — Rabu, 30 Juli: Integration + Bug Fix + Polish

### Nia — View Integration & QA
- [ ] Pastikan semua `@if`, `@auth`, `@foreach` di Blade benar dan tidak ada error view
- [ ] Error handling: custom page `404.blade.php`, `403.blade.php` (akses ditolak)
- [ ] Middleware `auth` sudah terpasang di semua route yang butuh login
- [ ] Test Google Login flow end-to-end (login → sesi → tampil avatar di navbar)
- [ ] Test flow utama: login → filter seminar → klik checkout → WA terbuka dengan pesan benar ✅
- [ ] Test library: langganan aktif → konten bisa diakses | belum langganan → locked ✅
- [ ] Animasi & transisi menggunakan Alpine.js (`x-transition`) dan CSS
- [ ] Mobile responsiveness final (375px, 768px, 1280px)

### Rafi — Backend Hardening & Deploy Staging
- [ ] Validasi semua form request (`FormRequest` class) untuk controller yang menerima input
- [ ] Middleware chain: `auth` untuk user, `IsAdmin` untuk `/admin/*`
- [ ] Test FR-07: `workshop_booking` dibuat → query `workshop_material` → akses material granted ✅
- [ ] Test FR-14: `Carbon::now()->lte($membership->active_until)` untuk status aktif/expired ✅
- [ ] Database seeder final — data realistis untuk demo
- [ ] **Deploy ke Railway/VPS** — setup `.env` production, `php artisan migrate --force`, `php artisan storage:link`
- [ ] Test semua halaman di URL production

---

## Hari 8 — Kamis, 31 Juli: FINAL DAY 🚀

### Nia — Final View Polish + Test Production
- [ ] Test semua halaman di URL production (mobile + desktop)
- [ ] Cek SEO tag muncul benar (`<title>`, meta description) di browser
- [ ] Fix hotfix kalau ada yang error di production
- [ ] Screenshot / rekam demo alur utama untuk dokumentasi

### Rafi — Final Backend + Dokumentasi
- [ ] Final check semua route & controller di production URL
- [ ] Update Google OAuth callback URL ke domain production di Google Cloud Console
- [ ] `php artisan route:cache` & `php artisan config:cache` untuk optimasi production
- [ ] Tulis `README.md` — cara setup, daftar fitur, env variables
- [ ] Backup database production

### Bersama (sore hari)
- [ ] Demo walkthrough bareng — tes semua user flow dari awal
- [ ] Fix last-minute bug kritis (maks 1–2 jam)
- [ ] **SHIP IT!** 🚢

---

## Ringkasan FR per Orang

### Nia (Blade Views + Controller user-facing)

| Hari | FR | Fitur |
|---|---|---|
| H1 | — | Layout utama, komponen Blade, routing user |
| H2 | FR-01, FR-02, FR-03 | Landing page + Navbar + Login Google UI |
| H3 | FR-04 | Katalog seminar + Filter Alpine.js + Detail seminar |
| H4 | FR-05, FR-06, FR-11, FR-12 | Library + Subscribe + Checkout WA link + Bookmark |
| H5 | FR-13, FR-14, FR-19 | Profil + Status langganan + Artikel SEO |
| H6 | FR-21, FR-10, FR-20 | Testimoni checkout + Halaman Mitra + Ajukan Seminar |
| H7 | — | View QA, error pages, animasi Alpine.js, responsif |
| H8 | — | Final test production + screenshot demo |

### Rafi (Migration + Model + Controller + Admin)

| Hari | FR | Fitur |
|---|---|---|
| H1 | — | Migration, Model, Seeder, OAuth setup, layout admin |
| H2 | FR-03 | AuthController Google + HomeController + Admin dashboard |
| H3 | FR-04, FR-17 | WorkshopController (filter) + Admin CRUD workshop |
| H4 | FR-09, FR-15, FR-16 | MaterialController (akses) + Admin ebook + Admin langganan |
| H5 | FR-13, FR-14, FR-19 | ProfileController + SubscriptionController + Admin artikel |
| H6 | FR-18, FR-21, FR-22 | Admin keuangan + Admin testimoni + query dashboard |
| H7 | FR-07 | Hardening, FormRequest, deploy ke staging |
| H8 | — | Final check + README + backup DB |

---

## Tabel ERD → Siapa yang Handle

| Tabel | Rafi (Migration + Model + Logic) | Nia (Blade View) |
|---|---|---|
| `account` | ✅ | ✅ (navbar, profil) |
| `user_session` | ✅ | — |
| `member` | ✅ | ✅ (edit profil) |
| `admin` | ✅ | — |
| `workshop` | ✅ | ✅ (katalog, detail, filter) |
| `workshop_material` | ✅ | — |
| `material` | ✅ | ✅ (library, locked/unlocked state) |
| `article` | ✅ | ✅ (list + detail artikel) |
| `testimonial` | ✅ | ✅ (landing + checkout) |
| `bookmark` | ✅ | ✅ (toggle button + list) |
| `membership` | ✅ | ✅ (status langganan) |
| `workshop_booking` | ✅ | ✅ (status booking) |

---

## Risiko & Mitigasi

| Risiko | Mitigasi |
|---|---|
| Google OAuth setup lama | Setup **bareng** di H1 pagi — jangan masing-masing |
| Nia butuh data tapi controller Rafi belum jadi | Rafi buat seeder dulu H1, Nia pakai data seeder untuk dev |
| Deploy error di menit terakhir | Deploy ke staging di H7, bukan H8 |
| Fitur bookmark/keuangan menyita waktu | Kalau mepet, skip `Could Have` — prioritas `Must Have` dulu |
| Konflik blade / merge hell | Pisah folder view: `pages/` untuk Nia, `admin/` untuk Rafi |

---

> 💡 **Tips**: Gunakan `@if(app()->environment('local'))` untuk hide fitur yang belum siap di production supaya demo tetap lancar.
