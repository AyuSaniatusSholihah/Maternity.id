# 7. Data Dictionary
Data dictionary berikut mendefinisikan entitas utama pada basis data Maternity.id beserta atribut, tipe data, dan deskripsinya, mengacu pada kebutuhan fungsional di bagian SRS.

## 7.1 Entity Relationship Overview
Entitas inti: `users`, `seminars`, `partners`, `subscriptions`, `payments`, `content_library`, `articles`, dan `bookmarks`. Relasi utama: satu user diautentikasi via Google OAuth dan dapat memiliki banyak subscriptions (kategori `ebook_all_access` dan/atau `seminar_access`) serta banyak bookmark; satu seminar dimiliki oleh satu partner dan dapat memiliki banyak subscriptions (`seminar_access`); konten pada `content_library` dapat dikaitkan ke seminar tertentu untuk menentukan hak akses otomatis. Layanan Fasilitator Mitra/Tour Guide Event sengaja tidak memiliki tabel tersendiri karena berupa tautan langsung ke WhatsApp CP Tim Maternity.id tanpa formulir maupun penyimpanan data di sisi aplikasi.

## 7.2 Tabel: users
| Field | Tipe Data | Deskripsi | Constraint |
|---|---|---|---|
| user_id | BIGINT | Identifier unik pengguna | PK, Auto Increment |
| google_id | VARCHAR(100) | ID unik akun Google (sub claim) dari hasil OAuth | NOT NULL, UNIQUE |
| full_name | VARCHAR(150) | Nama lengkap pengguna (dari profil Google) | NOT NULL |
| email | VARCHAR(150) | Alamat email akun Google pengguna | NOT NULL, UNIQUE |
| profile_picture_url | VARCHAR(255) | URL foto profil dari akun Google | NULLABLE |
| phone_number | VARCHAR(20) | Nomor HP/WhatsApp pengguna (diisi manual di profil) | NULLABLE |
| role | ENUM | guest, member, admin | NOT NULL, Default: member |
| created_at | TIMESTAMP | Waktu akun pertama kali login | NOT NULL |
| updated_at | TIMESTAMP | Waktu terakhir data diperbarui | NOT NULL |

## 7.3 Tabel: partners
| Field | Tipe Data | Deskripsi | Constraint |
|---|---|---|---|
| partner_id | BIGINT | Identifier unik mitra/owner seminar | PK, Auto Increment |
| owner_name | VARCHAR(150) | Nama pemilik seminar/pelatihan | NOT NULL |
| phone_number | VARCHAR(20) | Nomor WhatsApp mitra (untuk koordinasi internal Admin) | NOT NULL |
| submission_status | ENUM | menunggu_konfirmasi, terkonfirmasi, ditolak | Default: menunggu_konfirmasi |
| submitted_at | TIMESTAMP | Waktu pengajuan kolaborasi | NOT NULL |

## 7.4 Tabel: seminars
| Field | Tipe Data | Deskripsi | Constraint |
|---|---|---|---|
| seminar_id | BIGINT | Identifier unik seminar/pelatihan | PK, Auto Increment |
| partner_id | BIGINT | Relasi ke tabel partners | FK → partners.partner_id |
| seminar_name | VARCHAR(200) | Nama seminar/pelatihan | NOT NULL |
| topic | VARCHAR(150) | Topik/kategori seminar | NOT NULL |
| format | ENUM | online, offline, hybrid | NOT NULL |
| price | DECIMAL(12,2) | Harga langganan akses seminar ini | NOT NULL |
| location_or_link | VARCHAR(255) | Alamat maps (offline) atau tautan online meeting | NOT NULL |
| benefit_info | TEXT | Informasi benefit/nilai tambah seminar | NULLABLE |
| poster_url | VARCHAR(255) | URL poster seminar | NULLABLE |
| schedule_date | DATE | Tanggal pelaksanaan seminar | NOT NULL |
| schedule_time | TIME | Waktu pelaksanaan seminar | NOT NULL |
| status | ENUM | draft, published, closed | Default: draft |

## 7.5 Tabel: subscriptions
Menggantikan konsep booking/registrasi checkout otomatis. Setiap baris mewakili satu langganan yang diajukan pengguna dan ditetapkan (diaktifkan) secara manual oleh Admin setelah pembayaran dikonfirmasi via WhatsApp — tanpa memerlukan kode akses dari pengguna.
| Field | Tipe Data | Deskripsi | Constraint |
|---|---|---|---|
| subscription_id | BIGINT | Identifier unik langganan | PK, Auto Increment |
| user_id | BIGINT | Relasi ke tabel users | FK → users.user_id |
| subscription_type | ENUM | ebook_all_access, seminar_access | NOT NULL |
| seminar_id | BIGINT | Relasi ke tabel seminars; wajib diisi jika subscription_type = seminar_access, NULL jika ebook_all_access | FK → seminars.seminar_id, NULLABLE |
| start_date | DATE | Tanggal mulai langganan | NULLABLE hingga diaktifkan Admin |
| end_date | DATE | Tanggal berakhir langganan, sesuai rentang waktu yang diajukan saat pembayaran | NULLABLE hingga diaktifkan Admin |
| status | ENUM | menunggu_pembayaran, aktif, kedaluwarsa, dibatalkan | Default: menunggu_pembayaran |
| assigned_by_admin_id | BIGINT | Relasi ke tabel users (admin) yang menetapkan/mengaktifkan langganan ini | FK → users.user_id, NULLABLE |
| created_at | TIMESTAMP | Waktu pengajuan langganan dibuat | NOT NULL |

## 7.6 Tabel: payments
Mencatat konfirmasi pembayaran yang dilaporkan Admin setelah checkout via WhatsApp, digunakan sebagai sumber data dashboard keuangan.
| Field | Tipe Data | Deskripsi | Constraint |
|---|---|---|---|
| payment_id | BIGINT | Identifier unik catatan pembayaran | PK, Auto Increment |
| subscription_id | BIGINT | Relasi ke tabel subscriptions | FK → subscriptions.subscription_id |
| method | ENUM | e_wallet, m_banking, atm, qris, tunai | NOT NULL |
| amount | DECIMAL(12,2) | Jumlah pembayaran yang dikonfirmasi | NOT NULL |
| status | ENUM | pending, confirmed, failed | Default: pending |
| confirmed_by_admin_id | BIGINT | Relasi ke tabel users (admin) yang mengonfirmasi pembayaran | FK → users.user_id, NULLABLE |
| confirmed_at | TIMESTAMP | Waktu pembayaran dikonfirmasi Admin | NULLABLE |

## 7.7 Tabel: content_library
`related_seminar_id` menentukan hak akses otomatis: jika NULL, materi termasuk kategori umum (hanya dapat diakses oleh langganan ebook_all_access); jika diisi, materi juga otomatis dapat diakses oleh pengguna dengan langganan seminar_access untuk seminar tersebut.
| Field | Tipe Data | Deskripsi | Constraint |
|---|---|---|---|
| content_id | BIGINT | Identifier unik konten/e-book | PK, Auto Increment |
| title | VARCHAR(200) | Judul materi/e-book | NOT NULL |
| file_url | VARCHAR(255) | URL/lokasi berkas materi | NOT NULL |
| related_seminar_id | BIGINT | Relasi ke tabel seminars (jika materi khusus seminar tertentu) | FK → seminars.seminar_id, NULLABLE |
| uploaded_by | BIGINT | Relasi ke tabel users (admin) | FK → users.user_id |
| uploaded_at | TIMESTAMP | Waktu konten diunggah | NOT NULL |

## 7.8 Tabel: articles
Menyimpan artikel edukasi SEO (konsep serupa artikel Halodoc) yang tampil di halaman Artikel dan dapat ditemukan mesin pencari, masing-masing dapat ditautkan ke satu seminar untuk promosi di bagian akhir artikel.
| Field | Tipe Data | Deskripsi | Constraint |
|---|---|---|---|
| article_id | BIGINT | Identifier unik artikel | PK, Auto Increment |
| title | VARCHAR(200) | Judul artikel | NOT NULL |
| slug | VARCHAR(220) | URL slug deskriptif untuk SEO | NOT NULL, UNIQUE |
| content_body | TEXT | Isi artikel (mendukung format rich text) | NOT NULL |
| meta_description | VARCHAR(300) | Ringkasan untuk meta tag SEO | NULLABLE |
| cover_image_url | VARCHAR(255) | URL gambar sampul artikel | NULLABLE |
| related_seminar_id | BIGINT | Relasi ke tabel seminars untuk tautan promosi di akhir artikel | FK → seminars.seminar_id, NULLABLE |
| author_admin_id | BIGINT | Relasi ke tabel users (admin penulis) | FK → users.user_id |
| status | ENUM | draft, published | Default: draft |
| published_at | TIMESTAMP | Waktu artikel dipublikasikan | NULLABLE |

## 7.9 Tabel: bookmarks
| Field | Tipe Data | Deskripsi | Constraint |
|---|---|---|---|
| bookmark_id | BIGINT | Identifier unik bookmark | PK, Auto Increment |
| user_id | BIGINT | Relasi ke tabel users | FK → users.user_id |
| item_type | ENUM | seminar, materi, artikel | NOT NULL |
| item_id | BIGINT | ID item yang di-bookmark (seminar_id/content_id/article_id) | NOT NULL |
| created_at | TIMESTAMP | Waktu item ditandai | NOT NULL |
