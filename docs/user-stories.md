# 4. User Stories
Setiap user story ditulis dengan format: Sebagai [peran], saya ingin [tujuan/aksi], sehingga [manfaat].
> Diperbarui: Penambahan US-01b (Complete Profile), US-05b (Upload Bukti Bayar), US-07 (Status Pesanan), US-16 (Admin Verifikasi Order); revisi US-05 (Checkout), US-21 (Finance Dashboard), US-27 (Section Mitra di landing page).

---

## Epic 1 — Onboarding

1. **US-01** — Sebagai pengguna, saya ingin login menggunakan akun Google, sehingga saya dapat mengakses layanan Maternity.id tanpa perlu membuat akun atau password baru.

2. **US-01b** — Sebagai pengguna yang baru pertama kali login, saya ingin diarahkan ke halaman Lengkapi Data Diri (`/complete-profile`) untuk mengisi No. HP dan Alamat, sehingga data saya lengkap dan saya dapat melanjutkan ke proses checkout. Halaman ini hanya muncul satu kali selama `is_profile_complete = false`.

---

## Epic 2 — Katalog & Pencarian Seminar

3. **US-02** — Sebagai pengguna, saya ingin melihat katalog seminar yang tersedia di `/seminars`, sehingga saya dapat menelusuri pilihan seminar/pelatihan maternitas dengan mudah.

4. **US-03** — Sebagai pengguna, saya ingin memfilter katalog berdasarkan topik, lokasi, format, dan harga, sehingga saya dapat mempersempit pilihan sesuai preferensi.

5. **US-04** — Sebagai pengguna, saya ingin melihat detail lengkap seminar (deskripsi, benefit, harga, jadwal, format), sehingga saya dapat memutuskan apakah ingin berlangganan.

---

## Epic 3 — Checkout & Pembayaran Manual

6. **US-05** — Sebagai member, saya ingin memilih kategori langganan (Akses Ebook atau Akses Seminar tertentu) dan melakukan checkout, sehingga sistem membuat record pesanan saya dan saya diarahkan ke halaman pembayaran. Jika data diri saya belum lengkap, saya diarahkan ke `/complete-profile` terlebih dahulu.

7. **US-05b** — Sebagai member yang telah membuat pesanan, saya ingin melihat instruksi transfer (nomor rekening, nominal, nama tujuan, batas waktu) dan mengupload screenshot bukti transfer di halaman `/checkout/{order}/payment`, sehingga pesanan saya dapat diverifikasi oleh admin dan saya menerima konfirmasi via email bahwa bukti saya sudah diterima.

8. **US-06** — Sebagai member yang berlangganan Akses Seminar, saya ingin otomatis mendapat akses e-book terkait seminar tersebut setelah pesanan disetujui admin, sehingga saya tidak perlu membeli akses e-book secara terpisah.

9. **US-07** — Sebagai member, saya ingin memantau status pesanan saya secara real-time di `/orders/{id}`, sehingga saya tahu apakah pembayaran saya sedang menunggu verifikasi, sudah disetujui, atau ditolak. Jika ditolak, saya ingin melihat alasan dari admin dan dapat mengunggah ulang bukti pembayaran yang benar.

10. **US-08** — Sebagai member, saya ingin menghubungi customer service via WhatsApp saat ada kendala pesanan atau pembayaran, sehingga masalah saya cepat terselesaikan.

---

## Epic 4 — Membership, Library & Profil

11. **US-09** — Sebagai member, saya ingin mengakses e-book/materi sesuai jenis langganan aktif saya (seminar tertentu atau seluruh materi), sehingga saya mendapat konten yang sesuai hak akses saya.

12. **US-10** — Sebagai member, saya ingin menandai (bookmark) seminar/materi favorit, sehingga saya dapat menemukannya kembali dengan mudah di `/bookmarks`.

13. **US-11** — Sebagai member, saya ingin mengedit profil dan informasi akun saya di `/profile`, sehingga data saya selalu akurat.

14. **US-12** — Sebagai member, saya ingin melihat status dan masa berlaku tiap langganan saya di `/my-subscriptions`, sehingga saya tahu kapan harus memperpanjang.

---

## Epic 6 — Manajemen Mitra / Owner Seminar

15. **US-15** — Sebagai owner/mitra, saya ingin mengajukan seminar/pelatihan melalui halaman `/ajukan-seminar` (mengisi nama seminar, harga, lokasi/link, kontak, benefit, poster), sehingga kegiatan saya dapat dipromosikan di Maternity.id. Setelah mengisi form, saya akan diarahkan ke WhatsApp Admin untuk menindaklanjuti pengajuan.

---

## Epic 7 — Admin Panel

16. **US-16** — Sebagai admin, saya ingin membuka panel `admin/orders` untuk melihat daftar order pembayaran yang masuk, melihat detail bukti transfer yang diupload member, dan memilih Approve (mengaktifkan akses sekaligus menyediakan link WA pengiriman akses ke member) atau Reject (mengisi alasan penolakan agar member dapat melihatnya di `/orders/{id}` dan mengupload ulang), sehingga proses verifikasi pembayaran manual dapat berjalan terstruktur.

17. **US-17** — Sebagai admin, saya ingin mengunggah dan mengelola e-book/materi serta mengaitkannya dengan seminar tertentu, sehingga konten pembelajaran member selalu terbarui dan terhubung dengan benar.

18. **US-18** — Sebagai admin, saya ingin menetapkan langganan tiap user (seminar spesifik atau akses ebook penuh) beserta masa berlakunya setelah order diverifikasi, sehingga pengguna mendapat akses tanpa kode akses manual.

19. **US-19** — Sebagai admin, saya ingin mengunggah dan mengelola informasi seminar/pelatihan di panel admin, sehingga katalog selalu akurat dan terkini.

20. **US-21** — Sebagai admin, saya ingin melihat dashboard keuangan yang menampilkan: total nominal order berstatus `selesai`, jumlah order per status (menunggu verifikasi, diverifikasi, ditolak), jumlah langganan aktif per kategori, dan riwayat order yang telah diverifikasi, sehingga saya dapat memantau kinerja bisnis dan aliran pendapatan secara akurat.

---

## Epic 8 — Promosi & Integrasi TikTok

21. **US-22** — Sebagai pengguna TikTok, saya ingin diarahkan ke landing page Maternity.id dari konten FYP/promosi, sehingga saya dapat menindaklanjuti ketertarikan saya.

22. **US-23** — Sebagai guest, saya ingin melihat daftar seminar upcoming event di landing page tanpa harus login, sehingga saya tertarik untuk mendaftar.

---

## Epic 9 — Artikel SEO & Navigasi Konten

23. **US-24** — Sebagai guest/member, saya ingin membaca artikel edukasi maternitas yang muncul di hasil pencarian internet, sehingga saya menemukan Maternity.id secara organik dan mengetahui seminar terkait di akhir artikel.

24. **US-25** — Sebagai pengguna, saya ingin menggunakan navigasi atas (top navbar) untuk mengakses Info Seminar, Library, dan Artikel dari halaman manapun, sehingga saya dapat berpindah konten dengan cepat.

25. **US-26** — Sebagai admin, saya ingin menulis dan mempublikasikan artikel SEO beserta tautan promosi seminar terkait, sehingga artikel dapat mendukung akuisisi pengguna baru secara organik.

---

## Epic 10 — Layanan Fasilitator Mitra / Tour Guide Event

26. **US-27** — Sebagai tenaga profesional (dokter/instruktur), saya ingin melihat Section Mitra di dalam landing page Maternity.id dan menekan tombol "Butuh Fasilitator Event? Hubungi Kami", sehingga saya langsung terhubung ke WhatsApp CP Tim Maternity.id untuk mendiskusikan kebutuhan pelatihan mandiri saya (venue, logistik, nakes pendamping) tanpa harus mengisi formulir apapun.

---

## Epic 11 — Testimoni Pengguna

27. **US-28** — Sebagai pengguna, saya ingin melihat testimoni peserta lain di landing page dan halaman checkout, sehingga saya lebih yakin sebelum memutuskan berlangganan.

28. **US-29** — Sebagai admin, saya ingin mengelola konten testimoni (menambah, mengedit, menghapus, dan mengatur status tayang) di panel admin, sehingga testimoni yang tampil selalu relevan dan terpercaya.
