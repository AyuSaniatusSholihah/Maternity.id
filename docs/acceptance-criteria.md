# 5. Acceptance Criteria
Kriteria penerimaan ditulis dalam format Given–When–Then (Diberikan–Ketika–Maka) untuk setiap user story.
> Diperbarui: Penambahan kriteria untuk alur complete profile, pembayaran manual (upload bukti), status order, dan verifikasi admin.

---

## Epic 1 — Onboarding

### US-01 — Login menggunakan akun Google
1. **Diberikan** pengguna berada di halaman manapun dan belum login, **Ketika** menekan "Login dengan Google" dan mengonfirmasi akun Googlenya, **Maka** sistem membuat/mengenali akun dan mengecek `is_profile_complete`.
   - Jika `is_profile_complete = false` → redirect ke `/complete-profile`.
   - Jika `is_profile_complete = true` → redirect ke halaman semula atau `/seminars`.
2. **Diberikan** proses autentikasi Google gagal/dibatalkan, **Ketika** pengguna kembali ke website, **Maka** sistem menampilkan pesan bahwa login belum berhasil dan menyediakan tombol untuk mencoba lagi.

---

### US-01b — Melengkapi Data Diri *(Baru)*
3. **Diberikan** pengguna baru berhasil login dan `is_profile_complete = false`, **Ketika** diarahkan ke `/complete-profile`, **Maka** sistem menampilkan form isian data diri (No. HP, Alamat, Tanggal Lahir/HPL, dsb.) yang wajib diisi sebelum melanjutkan ke checkout.
4. **Diberikan** pengguna mengisi semua field wajib di `/complete-profile` dan menekan Simpan, **Ketika** form disubmit, **Maka** sistem menyimpan data, mengubah `is_profile_complete` menjadi `true`, dan mengarahkan user ke halaman yang semula dituju.
5. **Diberikan** pengguna yang `is_profile_complete = true` mencoba mengakses `/complete-profile`, **Ketika** URL dibuka, **Maka** sistem redirect ke `/seminars` atau halaman utama (tidak memaksa isi ulang).

---

## Epic 2 — Katalog & Pencarian Seminar

### US-02 — Melihat katalog seminar
6. **Diberikan** pengguna membuka `/seminars`, **Ketika** halaman dimuat, **Maka** sistem menampilkan daftar seminar/pelatihan maternitas yang tersedia.

### US-03 — Memfilter katalog
7. **Diberikan** pengguna berada di halaman katalog, **Ketika** memilih filter topik/lokasi/format/harga, **Maka** daftar seminar diperbarui sesuai kriteria yang dipilih.

### US-04 — Melihat detail seminar
8. **Diberikan** pengguna memilih satu seminar dari katalog, **Ketika** membuka halaman detail, **Maka** sistem menampilkan deskripsi, benefit, harga, jadwal, format (online/offline/hybrid), dan tombol "Daftar / Checkout".

---

## Epic 3 — Checkout & Pembayaran Manual

### US-05 — Memilih kategori langganan & Checkout *(Direvisi)*
9. **Diberikan** member berada di halaman seminar atau halaman checkout, **Ketika** memilih paket langganan dan menekan "Checkout", **Maka** sistem mengecek apakah `is_profile_complete = true`. Jika belum, redirect ke `/complete-profile`. Jika sudah, sistem membuat record `orders` (status `menunggu_pembayaran`) dan mengarahkan member ke halaman pembayaran.

### US-05b — Halaman Pembayaran & Upload Bukti Transfer *(Baru)*
10. **Diberikan** member berada di `/checkout/{order}/payment`, **Ketika** halaman dimuat, **Maka** sistem menampilkan: nomor rekening tujuan, nominal transfer, nama tujuan transfer, dan batas waktu pembayaran.
11. **Diberikan** member telah melakukan transfer dan ingin mengunggah bukti, **Ketika** memilih file gambar (maks 2MB, format JPG/PNG/WEBP) dan menekan "Kirim Bukti Pembayaran", **Maka** sistem menyimpan file, mengubah status order ke `menunggu_verifikasi`, mengirim `OrderReceivedMail` ke email member, dan menampilkan pesan konfirmasi bahwa bukti sedang diproses.
12. **Diberikan** member mengunggah file yang tidak valid (bukan gambar / ukuran melebihi batas), **Ketika** menekan submit, **Maka** sistem menampilkan pesan error validasi tanpa memproses upload.

### US-06 — Otomatis mendapat akses e-book terkait seminar
13. **Diberikan** Admin telah menyetujui order untuk Langganan Akses Seminar, **Ketika** member membuka `/library`, **Maka** sistem menampilkan e-book yang terkait dengan seminar tersebut (via relasi `workshop_material`) sebagai dapat diakses.

### US-07 — Memantau Status Pesanan *(Baru)*
14. **Diberikan** member telah membuat order, **Ketika** membuka `/orders/{id}`, **Maka** sistem menampilkan status terkini: `menunggu_pembayaran` / `menunggu_verifikasi` / `diverifikasi` / `ditolak` / `selesai`, beserta estimasi waktu verifikasi jika relevan.
15. **Diberikan** status order adalah `ditolak`, **Ketika** member membuka `/orders/{id}`, **Maka** sistem menampilkan alasan penolakan dari admin dan menampilkan form untuk mengunggah ulang bukti pembayaran.
16. **Diberikan** status order adalah `selesai`, **Ketika** member membuka `/orders/{id}`, **Maka** sistem menampilkan konfirmasi bahwa akses telah aktif dengan tautan ke `/library` atau `/my-subscriptions`.

### US-08 — Menghubungi CS untuk kendala
17. **Diberikan** member mengalami kendala saat checkout atau menunggu verifikasi terlalu lama, **Ketika** menekan tombol kontak CS/WhatsApp, **Maka** sistem membuka WhatsApp dengan pesan default menyertakan nomor order terkait.

---

## Epic 4 — Membership, Library & Profil

### US-09 — Mengakses e-book sesuai langganan aktif
18. **Diberikan** member memiliki Langganan Akses Ebook aktif, **Ketika** membuka `/library`, **Maka** sistem menampilkan seluruh e-book/materi yang dapat diunduh/dibaca.
19. **Diberikan** member hanya memiliki Langganan Akses Seminar tertentu, **Ketika** membuka `/library`, **Maka** sistem hanya menampilkan materi terkait seminar tersebut sebagai dapat diakses; materi lain tampil terkunci.

### US-10 — Bookmark seminar/materi
20. **Diberikan** member melihat seminar/materi, **Ketika** menekan ikon bookmark, **Maka** item tersimpan di `/bookmarks` dan dapat dihapus kembali.

### US-11 — Edit profil
21. **Diberikan** member berada di `/profile`, **Ketika** mengubah data dan menekan "Simpan", **Maka** sistem memperbarui data profil dan menampilkan konfirmasi berhasil.

### US-12 — Status & masa berlaku langganan
22. **Diberikan** member memiliki satu atau lebih langganan, **Ketika** membuka `/my-subscriptions`, **Maka** sistem menampilkan tiap langganan beserta status (aktif/kedaluwarsa) dan tanggal berakhirnya.

---

## Epic 6 — Manajemen Mitra / Owner Seminar

### US-15 — Mengajukan seminar
23. **Diberikan** owner/mitra membuka `/ajukan-seminar`, **Ketika** mengisi field wajib dan submit, **Maka** sistem mengarahkan ke WhatsApp Admin dengan ringkasan pengajuan tersebut.

---

## Epic 7 — Admin Panel

### US-16 — Admin verifikasi pembayaran *(Baru)*
24. **Diberikan** admin membuka `admin/orders`, **Ketika** halaman dimuat, **Maka** sistem menampilkan list semua order masuk beserta status, nama member, nominal, dan tombol aksi.
25. **Diberikan** admin membuka detail order di `admin/orders/{id}`, **Ketika** menekan "Approve", **Maka** sistem mengubah status order ke `diverifikasi`, mengaktifkan hak akses (membuat `membership` atau `workshop_booking`), dan menyediakan link WA prefilled untuk pengiriman akses ke member.
26. **Diberikan** admin membuka detail order dan menekan "Reject", **Ketika** mengisi alasan penolakan dan mengonfirmasi, **Maka** sistem mengubah status order ke `ditolak`, menyimpan alasan di `orders.rejection_reason`, dan member dapat melihat alasan di `/orders/{id}`.

### US-17 — Mengelola content library & kaitan seminar
27. **Diberikan** admin berada di panel content library, **Ketika** mengunggah file e-book dan (opsional) memilih seminar terkait, **Maka** file tersedia di library dengan hak akses sesuai kaitannya.

### US-18 — Menetapkan langganan tiap user
28. **Diberikan** admin membuka panel manajemen langganan dan menetapkan kategori beserta masa berlaku, **Ketika** menekan "Simpan", **Maka** status langganan user berubah aktif dan akses langsung tersedia di website.

### US-19 — Mengelola informasi seminar
29. **Diberikan** admin menambah/mengedit data seminar dan menekan "Simpan", **Ketika** data tersimpan, **Maka** katalog diperbarui sesuai perubahan.

### US-21 — Dashboard keuangan *(Direvisi)*
30. **Diberikan** admin membuka dashboard keuangan, **Ketika** halaman dimuat, **Maka** sistem menampilkan: total nominal order yang telah `selesai`, jumlah order per status, jumlah langganan aktif per kategori, dan riwayat order yang diverifikasi.
31. **Diberikan** admin memilih rentang tanggal tertentu, **Ketika** filter diterapkan, **Maka** dashboard memperbarui ringkasan sesuai rentang yang dipilih.

---

## Epic 8 — Promosi & Integrasi TikTok

### US-22 — Diarahkan dari TikTok ke landing page
32. **Diberikan** konten TikTok resmi Maternity.id menyertakan tautan/CTA, **Ketika** pengguna menekannya, **Maka** pengguna diarahkan ke landing page.

### US-23 — Melihat upcoming event sebagai guest
33. **Diberikan** pengguna belum login, **Ketika** membuka landing page, **Maka** sistem menampilkan daftar seminar upcoming tanpa memerlukan autentikasi.

---

## Epic 9 — Artikel SEO & Navigasi Konten

### US-24 — Membaca artikel SEO
34. **Diberikan** artikel telah dipublikasikan, **Ketika** pengguna membuka artikel, **Maka** sistem menampilkan isi artikel lengkap dengan tautan promosi ke seminar terkait di bagian akhir.

### US-25 — Navigasi atas (top navbar)
35. **Diberikan** pengguna berada di halaman manapun, **Ketika** menggunakan navbar, **Maka** sistem menampilkan tautan cepat ke Info Seminar, Library, dan Artikel.

### US-26 — Menulis & mempublikasikan artikel SEO
36. **Diberikan** admin mengisi judul, isi, meta description, dan (opsional) seminar terkait lalu menekan "Publikasikan", **Maka** artikel tampil di halaman Artikel dan dapat diakses publik.

---

## Epic 10 — Layanan Fasilitator Mitra / Tour Guide Event

### US-27 — Terhubung ke WhatsApp CP via Section Mitra di Landing Page *(Direvisi)*
37. **Diberikan** pengguna berada di landing page dan melihat Section Mitra, **Ketika** menekan tombol "Butuh Fasilitator Event? Hubungi Kami", **Maka** sistem langsung membuka WhatsApp menuju CP Tim Maternity.id (tautan `wa.me`) dengan pesan default, tanpa formulir dan tanpa penyimpanan data.

---

## Epic 11 — Testimoni Pengguna

### US-28 — Melihat testimoni
38. **Diberikan** testimoni berstatus `published`, **Ketika** pengguna membuka landing page atau halaman checkout, **Maka** sistem menampilkan testimoni sesuai `display_location`.

### US-29 — Mengelola testimoni
39. **Diberikan** admin berada di panel testimoni, **Ketika** menambah, mengedit, menghapus, atau mengubah status tayang testimoni dan menekan "Simpan", **Maka** perubahan segera tercermin di halaman publik.
