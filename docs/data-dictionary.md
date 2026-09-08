# 7. Data Dictionary
Data dictionary berikut mendefinisikan entitas utama pada basis data Maternity.id beserta atribut, tipe data, dan deskripsinya, mengacu pada kebutuhan fungsional di bagian SRS.
> Diperbarui: Penambahan tabel `orders` dan field baru di tabel `member` sesuai alur pembayaran manual.

## 7.1 Entity Relationship Overview
Entitas inti: `account`, `member`, `admin`, `workshop`, `material`, `orders`, `membership`, `workshop_booking`, `article`, `testimonial`, dan `bookmark`.

Relasi utama:
- Satu `account` diautentikasi via Google OAuth dan dapat menjadi `member` atau `admin`.
- Setelah login, sistem mengecek `member.is_profile_complete`. Jika `false`, user diarahkan ke `/complete-profile` untuk mengisi `phone_number`, `address`, dan data diri lainnya.
- Setelah profil lengkap, `member` dapat membuat `orders` yang bersifat polymorphic ke `membership` (langganan ebook) atau `workshop_booking` (langganan seminar).
- `orders` menyimpan `payment_proof` (bukti transfer) dan `status` alur pembayaran manual.
- Admin memverifikasi `orders` via panel `admin/orders`, lalu mengaktifkan hak akses melalui `membership` atau `workshop_booking`.
- Layanan Fasilitator Mitra tidak memiliki tabel — berupa direct link WhatsApp tanpa formulir.

---

## 7.2 Tabel: account
Identitas utama semua pengguna. Semua aktor berasal dari sini via Google OAuth.

| Field | Tipe Data | Deskripsi | Constraint |
|---|---|---|---|
| `id` | CHAR(36) | UUID identitas unik pengguna | PK, UNIQUE, NOT NULL |
| `email` | VARCHAR(255) | Alamat email akun Google | NOT NULL, UNIQUE |
| `name` | VARCHAR(255) | Nama dari profil Google | NOT NULL |
| `profile_img` | VARCHAR(255) | URL foto profil dari Google | NULLABLE |

---

## 7.3 Tabel: user_session
Menyimpan riwayat sesi login. Digunakan untuk validasi token dan tracking device.

| Field | Tipe Data | Deskripsi | Constraint |
|---|---|---|---|
| `id` | CHAR(36) | UUID sesi | PK, UNIQUE |
| `account_id` | CHAR(36) | Relasi ke `account` | FK → account.id, NOT NULL |
| `device_type` | VARCHAR | Mobile / Desktop | NULLABLE |
| `os_name` | VARCHAR | Sistem operasi | NULLABLE |
| `os_version` | VARCHAR | Versi OS | NULLABLE |
| `browser_name` | VARCHAR | Nama browser | NULLABLE |
| `browser_version` | VARCHAR | Versi browser | NULLABLE |
| `token` | TEXT | Sesi token | NOT NULL |
| `logged_in_at` | DATETIME | Waktu login | NOT NULL |
| `logged_out_at` | DATETIME | Waktu logout (null = aktif) | NULLABLE |

---

## 7.4 Tabel: member
Data profil member. Dilengkapi melalui halaman `/complete-profile` setelah login Google pertama kali.

| Field | Tipe Data | Deskripsi | Constraint |
|---|---|---|---|
| `account_id` | CHAR(36) | Relasi ke `account` | PK, FK → account.id |
| `salutation` | ENUM | Sapaan: Ibu / Bunda / Mbak / dsb. | NOT NULL |
| `gender` | ENUM | Jenis kelamin | NOT NULL |
| `birth_date` | DATE | Tanggal lahir | NOT NULL |
| `date_of_pregnancy` | DATE | Perkiraan hari lahir (HPL) | NULLABLE |
| `phone_number` | VARCHAR(20) | Nomor HP/WhatsApp aktif | NULLABLE |
| `address` | TEXT | Alamat domisili member | NULLABLE |
| `is_profile_complete` | BOOLEAN | Flag: apakah data diri sudah dilengkapi via `/complete-profile`. `false` = user akan diredirect sebelum checkout. Diset `true` setelah form berhasil disubmit. | NOT NULL, DEFAULT false |
| `provision_by` | CHAR(36) | Admin yang mendaftarkan member | FK → admin.account_id, NULLABLE |

---

## 7.5 Tabel: admin
Data profil admin yang mengelola konten, verifikasi order, langganan, dan keuangan.

| Field | Tipe Data | Deskripsi | Constraint |
|---|---|---|---|
| `account_id` | CHAR(36) | Relasi ke `account` | PK, FK → account.id |
| `assigned_at` | DATE | Tanggal ditugaskan sebagai admin | NOT NULL |
| `position` | ENUM | `maintainer` atau `consultant` | NOT NULL |
| `number_contact` | VARCHAR(15) | Nomor WA/HP admin | NOT NULL |

---

## 7.6 Tabel: workshop
Seminar/pelatihan maternitas yang tersedia di katalog.

| Field | Tipe Data | Deskripsi | Constraint |
|---|---|---|---|
| `id` | CHAR(36) | UUID seminar | PK, UNIQUE |
| `name` | VARCHAR(255) | Nama seminar/workshop | NOT NULL |
| `slug` | VARCHAR(260) | URL-friendly slug | UNIQUE, NOT NULL |
| `description` | TEXT | Deskripsi lengkap | NOT NULL |
| `topic` | VARCHAR(100) | Topik (Yoga, Laktasi, Nifas, dsb.) | NOT NULL |
| `format` | ENUM | `online` / `offline` / `hybrid` | NOT NULL |
| `date` | DATE | Tanggal pelaksanaan | NOT NULL |
| `price` | DECIMAL(10,2) | Harga seminar | NOT NULL, DEFAULT 0 |
| `location_string` | TEXT | Alamat teks (offline) | NULLABLE |
| `location_maps` | TEXT | URL Google Maps embed | NULLABLE |
| `thumbnail_image` | VARCHAR(255) | Gambar cover seminar | NULLABLE |
| `status` | ENUM | `upcoming` / `ongoing` / `done` / `cancelled` | NOT NULL, DEFAULT 'upcoming' |
| `created_by` | CHAR(36) | Admin yang membuat seminar | FK → admin.account_id, NOT NULL |

---

## 7.7 Tabel: material
E-book dan materi edukatif yang tersedia di library.

| Field | Tipe Data | Deskripsi | Constraint |
|---|---|---|---|
| `id` | CHAR(36) | UUID materi | PK, UNIQUE |
| `name` | VARCHAR(255) | Judul e-book/materi | NOT NULL |
| `slug` | VARCHAR(260) | URL-friendly slug | UNIQUE, NOT NULL |
| `description` | TEXT | Deskripsi singkat | NULLABLE |
| `thumbnail_image` | VARCHAR(255) | Gambar cover | NULLABLE |
| `content_link` | TEXT | URL file (Google Drive, dsb.) | NOT NULL |
| `viewer_count` | INT | Jumlah viewer | NOT NULL, DEFAULT 0 |
| `uploaded_by` | CHAR(36) | Admin yang mengupload | FK → admin.account_id, NOT NULL |

---

## 7.8 Tabel: workshop_material
Pivot many-to-many antara `workshop` dan `material`.

| Field | Tipe Data | Deskripsi | Constraint |
|---|---|---|---|
| `workshop_id` | CHAR(36) | Relasi ke `workshop` | PK (composite), FK → workshop.id |
| `material_id` | CHAR(36) | Relasi ke `material` | PK (composite), FK → material.id |

---

## 7.9 Tabel: article
Artikel edukasi SEO yang ditulis admin dan dapat mempromosikan seminar terkait.

| Field | Tipe Data | Deskripsi | Constraint |
|---|---|---|---|
| `id` | CHAR(36) | UUID artikel | PK, UNIQUE |
| `title` | VARCHAR(255) | Judul artikel | NOT NULL |
| `slug` | VARCHAR(260) | Slug SEO | UNIQUE, NOT NULL |
| `content` | LONGTEXT | Isi artikel (rich text/HTML) | NOT NULL |
| `meta_title` | VARCHAR(255) | Meta title untuk SEO | NULLABLE |
| `meta_description` | VARCHAR(160) | Meta description SEO (maks 160 karakter) | NULLABLE |
| `thumbnail_image` | VARCHAR(255) | Gambar utama / OG image | NULLABLE |
| `related_workshop_id` | CHAR(36) | Workshop yang dipromosikan di akhir artikel | FK → workshop.id, NULLABLE |
| `author_id` | CHAR(36) | Admin penulis artikel | FK → admin.account_id, NOT NULL |
| `status` | ENUM | `draft` / `published` | NOT NULL, DEFAULT 'draft' |
| `published_at` | DATETIME | Waktu publish | NULLABLE |

---

## 7.10 Tabel: testimonial
Testimoni member yang dikurasi admin. Ditampilkan di landing page dan/atau halaman checkout.

| Field | Tipe Data | Deskripsi | Constraint |
|---|---|---|---|
| `id` | CHAR(36) | UUID testimoni | PK, UNIQUE |
| `name` | VARCHAR(100) | Nama pemberi testimoni | NOT NULL |
| `photo` | VARCHAR(255) | URL foto profil | NULLABLE |
| `content` | TEXT | Isi testimoni | NOT NULL |
| `role` | VARCHAR(100) | Peran/deskripsi (mis. "Peserta Seminar Laktasi") | NULLABLE |
| `display_location` | ENUM | `landing` / `checkout` / `both` | NOT NULL |
| `status` | ENUM | `published` / `hidden` | NOT NULL, DEFAULT 'hidden' |
| `sort_order` | INT | Urutan tampil | NOT NULL, DEFAULT 0 |

---

## 7.11 Tabel: bookmark
Bookmark seminar atau materi yang disimpan member.

| Field | Tipe Data | Deskripsi | Constraint |
|---|---|---|---|
| `id` | CHAR(36) | UUID bookmark | PK, UNIQUE |
| `member_id` | CHAR(36) | Relasi ke `member` | FK → member.account_id, NOT NULL |
| `bookmarkable_id` | CHAR(36) | ID target (workshop.id / material.id) | NOT NULL |
| `bookmarkable_type` | VARCHAR(50) | Jenis target: `workshop` atau `material` | NOT NULL |

> Index UNIQUE pada `(member_id, bookmarkable_id, bookmarkable_type)` untuk mencegah duplikat bookmark.

---

## 7.12 Tabel: orders *(Baru)*
Transaksi pemesanan dan bukti pembayaran manual per member. Dibuat saat member melakukan checkout, sebelum admin memverifikasi.

| Field | Tipe Data | Deskripsi | Constraint |
|---|---|---|---|
| `id` | CHAR(36) | UUID order | PK |
| `member_id` | CHAR(36) | Member yang melakukan order | FK → member.account_id, NOT NULL |
| `orderable_type` | VARCHAR(50) | Polymorphic type: `membership` atau `workshop_booking` | NOT NULL |
| `orderable_id` | CHAR(36) | ID entitas yang dipesan (ID dari `membership` / `workshop_booking`) | NOT NULL |
| `amount` | DECIMAL(10,2) | Nominal yang harus dibayarkan | NOT NULL |
| `payment_proof` | VARCHAR(255) | Path file bukti transfer (screenshot) | NULLABLE |
| `status` | ENUM | Alur status order: `menunggu_pembayaran` → `menunggu_verifikasi` → `diverifikasi` / `ditolak` → `selesai` | NOT NULL, DEFAULT 'menunggu_pembayaran' |
| `rejection_reason` | TEXT | Alasan penolakan dari admin (opsional, muncul jika status = `ditolak`) | NULLABLE |
| `verified_by` | CHAR(36) | Admin yang memverifikasi | FK → admin.account_id, NULLABLE |
| `verified_at` | DATETIME | Timestamp verifikasi | NULLABLE |
| `created_at` | DATETIME | Timestamp order dibuat | NOT NULL |
| `updated_at` | DATETIME | Timestamp order terakhir diperbarui | NOT NULL |

### Alur Status `orders.status`
```
menunggu_pembayaran  →  (user upload bukti)  →  menunggu_verifikasi
                                                       ↓
                                         admin approve / reject
                                          ↓                  ↓
                                      diverifikasi         ditolak
                                          ↓                  ↓
                                    (akses dikirim)   (user re-upload)
                                          ↓
                                        selesai
```

---

## 7.13 Tabel: membership
Langganan Akses Ebook aktif untuk member. Diaktifkan setelah order `diverifikasi` admin.

| Field | Tipe Data | Deskripsi | Constraint |
|---|---|---|---|
| `id` | CHAR(36) | UUID | PK |
| `member_id` | CHAR(36) | Pemegang langganan | FK → member.account_id, NOT NULL |
| `active_from` | DATE | Awal masa aktif | NOT NULL |
| `active_until` | DATE | Akhir masa aktif | NOT NULL |
| `amount_paid` | DECIMAL(10,2) | Nominal pembayaran | NOT NULL |
| `provision_by` | CHAR(36) | Admin yang mengaktifkan | FK → admin.account_id, NOT NULL |
| `booked_at` | DATETIME | Timestamp pencatatan oleh admin | NOT NULL |

---

## 7.14 Tabel: workshop_booking
Langganan Akses Seminar aktif untuk member. Diaktifkan setelah order `diverifikasi` admin.

| Field | Tipe Data | Deskripsi | Constraint |
|---|---|---|---|
| `id` | CHAR(36) | UUID | PK |
| `member_id` | CHAR(36) | Member yang memesan | FK → member.account_id, NOT NULL |
| `workshop_id` | CHAR(36) | Workshop yang dipesan | FK → workshop.id, NOT NULL |
| `amount_paid` | DECIMAL(10,2) | Nominal pembayaran | NOT NULL |
| `provision_by` | CHAR(36) | Admin yang mengaktifkan | FK → admin.account_id, NOT NULL |
| `booked_at` | DATETIME | Timestamp pencatatan oleh admin | NOT NULL |
