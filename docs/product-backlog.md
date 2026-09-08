# 3. Product Backlog
Backlog disusun dalam 11 epic utama, diprioritaskan menggunakan metode MoSCoW (Must have, Should have, Could have, Won't have for now) dan estimasi Story Point (skala Fibonacci: 1, 2, 3, 5, 8, 13).
> Diperbarui: Penambahan US-01b (Complete Profile), US-05b (Upload Bukti Bayar), US-07 (Status Pesanan), US-16 (Admin Verifikasi Order), revisi US-05 (Checkout), revisi US-21 (Finance Dashboard dari `orders`), revisi US-27 (Section Mitra di landing page).

---

## Epic 1 — Onboarding
| ID | User Story (ringkas) | Prioritas | SP |
|---|---|---|---|
| US-01 | Login menggunakan akun Google; sistem mengecek `is_profile_complete` setelah login | Must | 2 |
| US-01b | Melengkapi data diri di `/complete-profile` (No. HP, Alamat) sebelum dapat checkout; muncul sekali ketika `is_profile_complete = false` | Must | 3 |

---

## Epic 2 — Katalog & Pencarian Seminar
| ID | User Story (ringkas) | Prioritas | SP |
|---|---|---|---|
| US-02 | Melihat katalog seminar yang tersedia | Must | 5 |
| US-03 | Memfilter katalog (topik, lokasi, format, harga) | Should | 3 |
| US-04 | Melihat detail seminar (deskripsi, benefit, harga, jadwal) | Must | 3 |

---

## Epic 3 — Checkout & Pembayaran Manual
| ID | User Story (ringkas) | Prioritas | SP |
|---|---|---|---|
| US-05 | Memilih kategori langganan (Akses Ebook / Akses Seminar) dan melakukan checkout; sistem membuat record `orders` | Must | 5 |
| US-05b | Melihat instruksi pembayaran (info rekening, nominal) dan mengupload bukti transfer di `/checkout/{order}/payment`; sistem mengirim `OrderReceivedMail` ke user | Must | 8 |
| US-06 | Otomatis mendapat akses e-book terkait setelah order Akses Seminar disetujui admin | Must | 3 |
| US-07 | Memantau status pesanan real-time di `/orders/{id}` (`menunggu_pembayaran` → `menunggu_verifikasi` → `diverifikasi`/`ditolak` → `selesai`); bisa re-upload bukti jika ditolak | Must | 5 |
| US-08 | Menghubungi CS via WhatsApp jika ada kendala pesanan/pembayaran | Should | 2 |

---

## Epic 4 — Membership, Library & Profil
| ID | User Story (ringkas) | Prioritas | SP |
|---|---|---|---|
| US-09 | Mengakses e-book/materi sesuai jenis langganan aktif | Must | 5 |
| US-10 | Bookmark seminar/materi favorit | Could | 2 |
| US-11 | Mengedit profil dan informasi akun di `/profile` | Should | 2 |
| US-12 | Melihat status & masa berlaku tiap langganan di `/my-subscriptions` | Must | 3 |

---

## Epic 6 — Manajemen Mitra / Owner Seminar
| ID | User Story (ringkas) | Prioritas | SP |
|---|---|---|---|
| US-15 | Mengajukan seminar melalui `/ajukan-seminar` (form diarahkan ke WA Admin) | Must | 3 |

---

## Epic 7 — Admin Panel
| ID | User Story (ringkas) | Prioritas | SP |
|---|---|---|---|
| US-16 | Admin memverifikasi order pembayaran di `admin/orders`: lihat bukti bayar, Approve (aktifkan akses + link WA) atau Reject (isi alasan + notifikasi member) | Must | 8 |
| US-17 | Mengunggah & mengelola e-book/materi, termasuk kaitannya ke seminar tertentu | Must | 5 |
| US-18 | Menetapkan/mengatur langganan tiap user secara manual di panel admin | Must | 5 |
| US-19 | Mengunggah & mengelola informasi seminar/pelatihan | Must | 5 |
| US-21 | Melihat dashboard keuangan: total order `selesai`, jumlah per status order, langganan aktif per kategori | Must | 5 |

---

## Epic 8 — Promosi & Integrasi TikTok
| ID | User Story (ringkas) | Prioritas | SP |
|---|---|---|---|
| US-22 | Diarahkan dari konten TikTok menuju landing page Maternity.id | Should | 3 |
| US-23 | Melihat seminar upcoming event di landing page sebagai guest | Could | 2 |

---

## Epic 9 — Artikel SEO & Navigasi Konten
| ID | User Story (ringkas) | Prioritas | SP |
|---|---|---|---|
| US-24 | Membaca artikel edukasi SEO yang diakhiri CTA promosi seminar terkait | Could | 3 |
| US-25 | Menggunakan navbar untuk akses cepat ke Seminar/Library/Artikel dari halaman manapun | Should | 2 |
| US-26 | Menulis & mempublikasikan artikel SEO sebagai admin | Must | 5 |

---

## Epic 10 — Layanan Fasilitator Mitra / Tour Guide Event
| ID | User Story (ringkas) | Prioritas | SP |
|---|---|---|---|
| US-27 | Menekan tombol WA Fasilitator di **Section Mitra** (di dalam landing page, bukan halaman terpisah) → langsung terhubung ke WhatsApp CP Tim Maternity.id | Should | 2 |

---

## Epic 11 — Testimoni Pengguna
| ID | User Story (ringkas) | Prioritas | SP |
|---|---|---|---|
| US-28 | Melihat testimoni member di landing page & halaman checkout | Should | 3 |
| US-29 | Mengelola konten testimoni sebagai admin (tambah, edit, hapus, toggle status tayang) | Must | 5 |

---

> **Total**: 31 user story pada rilis awal (MVP). Fokus prioritas **Must Have** pada Epic 1–3 dan 6–7 untuk memenuhi alur inti: login Google → lengkapi data diri (satu kali) → temukan seminar → pilih langganan → checkout & upload bukti bayar → admin verifikasi → akses aktif, serta operasional admin, akuisisi organik via artikel SEO, Section Mitra di landing page, dan testimoni pengguna.
