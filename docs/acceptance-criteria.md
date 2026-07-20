# 5. Acceptance Criteria
Kriteria penerimaan ditulis dalam format Given–When–Then (Diberikan–Ketika–Maka) untuk setiap user story.

## Epic 1 — Onboarding
### US-01 — Login menggunakan akun Google
1. Diberikan pengguna berada di halaman utama, Ketika menekan "Login dengan Google" dan memilih/mengonfirmasi akun Google-nya, Maka sistem membuat/mengenali akun pengguna dan mengarahkannya ke halaman katalog seminar.
2. Diberikan proses autentikasi Google gagal/dibatalkan, Ketika pengguna kembali ke website, Maka sistem menampilkan pesan bahwa login belum berhasil dan menyediakan tombol untuk mencoba lagi.

## Epic 2 — Katalog & Pencarian Seminar
### US-02 — Melihat katalog seminar
3. Diberikan pengguna membuka halaman katalog, Ketika halaman dimuat, Maka sistem menampilkan daftar seminar/pelatihan maternitas yang tersedia.

### US-03 — Memfilter katalog
4. Diberikan pengguna berada di halaman katalog, Ketika memilih filter topik/lokasi/format/harga, Maka daftar seminar diperbarui sesuai kriteria yang dipilih.

### US-04 — Melihat detail seminar
5. Diberikan pengguna memilih satu seminar dari katalog, Ketika membuka halaman detail, Maka sistem menampilkan deskripsi, benefit, harga, jadwal, format (online/offline/hybrid), dan tombol pilihan langganan.

## Epic 3 — Langganan & Aktivasi Akses via WhatsApp Admin
### US-05 — Memilih kategori langganan & checkout via WA Admin
6. Diberikan pengguna berada di halaman seminar atau halaman langganan, Ketika memilih "Langganan Akses Ebook" atau "Langganan Akses Seminar" dan menekan "Checkout", Maka sistem mengarahkan pengguna ke WhatsApp Admin Maternity.id beserta ringkasan kategori, seminar (jika berlaku), dan estimasi harga, serta mencatat pengajuan berstatus "menunggu pembayaran".

### US-06 — Otomatis mendapat akses e-book terkait
7. Diberikan Admin telah mengaktifkan Langganan Akses Seminar untuk seorang pengguna, Ketika pengguna membuka halaman library, Maka sistem menampilkan e-book/materi yang terkait dengan seminar tersebut sebagai dapat diakses, tanpa langganan tambahan.


### US-08 — Menghubungi CS untuk kendala langganan/pembayaran
10. Diberikan pengguna mengalami kendala saat checkout atau menunggu aktivasi terlalu lama, Ketika menekan tombol kontak CS/WhatsApp, Maka sistem membuka kanal chat/WhatsApp dengan konteks data langganan yang bersangkutan.

## Epic 4 — Membership, Library & Profil
### US-09 — Mengakses e-book sesuai langganan aktif
11. Diberikan pengguna memiliki Langganan Akses Ebook aktif, Ketika membuka halaman library, Maka sistem menampilkan seluruh e-book/materi yang dapat diunduh atau dibaca.
12. Diberikan pengguna hanya memiliki Langganan Akses Seminar tertentu, Ketika membuka halaman library, Maka sistem hanya menampilkan materi yang terkait dengan seminar tersebut sebagai dapat diakses, dan materi lain tampil terkunci.

### US-10 — Bookmark seminar/materi
13. Diberikan member melihat seminar/materi, Ketika menekan ikon bookmark, Maka item tersimpan pada halaman "Bookmark Saya" dan dapat dihapus kembali.

### US-11 — Edit profil
14. Diberikan member berada di halaman profil, Ketika mengubah data dan menekan "Simpan", Maka sistem memperbarui data profil dan menampilkan konfirmasi berhasil.

### US-12 — Status & masa berlaku langganan
15. Diberikan member memiliki satu atau lebih langganan, Ketika membuka halaman profil/langganan saya, Maka sistem menampilkan tiap kategori langganan beserta status (aktif/kedaluwarsa) dan tanggal berakhirnya.

## Epic 6 — Manajemen Mitra / Owner Seminar
### US-15 — Mengajukan seminar (Ajukan Seminar)
18. Diberikan owner/mitra membuka fitur "Ajukan Seminar", Ketika mengisi seluruh field wajib (nama seminar, nama pemilik, harga, alamat/link, kontak, benefit, poster) dan submit, Maka sistem menyimpan pengajuan berstatus "menunggu konfirmasi".


## Epic 7 — Admin Panel
### US-17 — Mengelola content library & kaitan seminar
20. Diberikan admin berada di panel content library, Ketika mengunggah file e-book/materi baru dan (opsional) memilih seminar terkait, Maka file tersedia di library dengan hak akses sesuai kaitannya (materi umum vs materi khusus seminar tertentu).

### US-18 — Menetapkan langganan tiap user
21. Diberikan pembayaran seorang pengguna telah dikonfirmasi via WhatsApp, Ketika admin membuka panel manajemen langganan dan menetapkan kategori (Akses Ebook/Akses Seminar tertentu) beserta masa berlaku untuk pengguna tersebut, Maka status langganan pengguna berubah menjadi "aktif" dan akses terkait langsung tersedia di website tanpa kode akses.
22. Diberikan admin salah menetapkan kategori/masa berlaku, Ketika admin mengedit data langganan, Maka sistem memperbarui hak akses pengguna sesuai perubahan terbaru.

### US-19 — Mengelola informasi seminar
23. Diberikan admin menambah/mengedit data seminar, Ketika menekan "Simpan", Maka data pada katalog diperbarui sesuai perubahan.


### US-21 — Dashboard keuangan
25. Diberikan admin membuka dashboard keuangan, Ketika halaman dimuat, Maka sistem menampilkan ringkasan total pendapatan, jumlah langganan aktif per kategori (Akses Ebook vs Akses Seminar), dan riwayat pembayaran yang telah dikonfirmasi.
26. Diberikan admin memilih rentang tanggal tertentu, Ketika filter diterapkan, Maka dashboard memperbarui ringkasan sesuai rentang yang dipilih.

## Epic 8 — Promosi & Integrasi TikTok
### US-22 — Diarahkan dari TikTok ke landing page
27. Diberikan konten TikTok resmi Maternity.id menyertakan tautan/CTA, Ketika pengguna menekannya, Maka pengguna diarahkan langsung ke landing page website.

### US-23 — Melihat upcoming event sebagai guest
28. Diberikan pengguna belum login, Ketika membuka landing page, Maka sistem menampilkan daftar seminar upcoming event tanpa memerlukan autentikasi.

## Epic 9 — Artikel SEO & Navigasi Konten
### US-24 — Membaca artikel SEO
29. Diberikan artikel telah dipublikasikan, Ketika pengguna membuka artikel dari hasil pencarian atau dari halaman Artikel, Maka sistem menampilkan isi artikel lengkap dengan tautan promosi ke seminar terkait di bagian akhir artikel.

### US-25 — Navigasi atas (top navbar)
30. Diberikan pengguna berada di halaman manapun pada website, Ketika membuka navigasi atas, Maka sistem menampilkan tautan cepat ke Info Seminar, Ebook/Library, dan Artikel yang dapat diakses tanpa perlu kembali ke landing page.

### US-26 — Menulis & mempublikasikan artikel SEO
31. Diberikan admin berada di panel manajemen artikel, Ketika mengisi judul, isi, meta description, dan (opsional) seminar terkait lalu menekan "Publikasikan", Maka artikel tampil di halaman Artikel dan dapat diakses publik dengan tautan promosi seminar di bagian akhir.

## Epic 10 — Layanan Fasilitator Mitra / Tour Guide Event
### US-27 — Terhubung langsung ke WhatsApp CP Tim Maternity.id
32. Diberikan pengguna berada di halaman kemitraan, Ketika menekan tombol "Butuh Fasilitator Event? Hubungi Kami", Maka sistem langsung membuka WhatsApp menuju CP Tim Maternity.id (tautan wa.me) dengan pesan default terkait permintaan fasilitator event, tanpa menampilkan formulir maupun menyimpan data apa pun di database.
