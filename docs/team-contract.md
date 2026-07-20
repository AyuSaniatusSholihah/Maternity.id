# 6. Team Contract — Tim Pengembangan Website
Team Contract ini berfokus pada kesepakatan teknis tim dalam merealisasikan website maternity.id, mencakup pembagian peran teknis, tech stack, alur kerja Git, standar kode, proses testing, hingga deployment.

## 6.1 Peran Teknis dalam Pengembangan
| Peran Teknis | PIC | Tanggung Jawab |
|---|---|---|
| Product Owner / Requirement Lead | Ayu Saniatus Sholihah | Menyusun & memelihara Product Backlog, User Story, Acceptance Criteria; memprioritaskan fitur tiap sprint; menjadi penghubung kebutuhan bisnis ↔ tim teknis |
| Technical Lead / Backend & Infrastructure | Helmi Arrafif Kanahaya | Merancang arsitektur sistem, mengembangkan backend & API, mengelola basis data, server, dan proses deployment |
| UI/UX & Frontend Support | Ayu Saniatus Sholihah | Merancang alur antarmuka (katalog, booking), implementasi tampilan frontend |
| Domain Content Reviewer | Fatwa Isnaya Echa Anastasya, Hasna Salsabila, Nadila Putri Novitasari Arrahmah | Memvalidasi keakuratan konten kesehatan maternal, redaksi materi e-book/library dari sisi kebidanan |
| QA / User Acceptance Tester | Seluruh anggota tim (bergantian per sprint) | Menguji fitur yang selesai dikembangkan terhadap Acceptance Criteria sebelum dinyatakan Done |

## 6.2 Tech Stack yang Disepakati
| Komponen | Teknologi/Tools |
|---|---|
| Frontend | HTML/CSS/JavaScript (framework ditentukan Technical Lead, mis. React/Vue) dengan pendekatan mobile-responsive dan SEO-friendly (SSR/prerender untuk halaman artikel) |
| Backend | REST API (bahasa/framework ditentukan Technical Lead, mis. Laravel/Node.js) |
| Basis Data | Relational database (MySQL/PostgreSQL) sesuai struktur pada Data Dictionary |
| Autentikasi | Google OAuth 2.0 sebagai satu-satunya metode login (tanpa email/password internal) |
| Checkout Langganan | Tautan WhatsApp Admin (wa.me) untuk proses pembayaran; aktivasi akses dilakukan manual oleh Admin di panel admin |
| Version Control | Git, dengan remote repository di GitHub/GitLab |
| Project Tracking | Papan kanban (mis. Trello/Notion/Jira) mengacu pada Product Backlog |
| Deployment | Staging environment untuk QA, production environment untuk rilis final |

## 6.3 Alur Kerja Git & Standar Kode
- Branch utama: `main` (produksi) dan `develop` (integrasi fitur); setiap fitur dikerjakan pada branch terpisah dengan format `feature/nama-fitur`.
- Commit message mengikuti format singkat dan jelas, mis. `feat: tambah endpoint booking seminar` atau `fix: perbaiki validasi form Ajukan Seminar`.
- Setiap perubahan pada `develop` atau `main` wajib melalui Pull Request dan direview minimal oleh Technical Lead sebelum di-merge.
- Kode mengikuti konvensi penamaan yang konsisten dan disertai komentar pada bagian logika yang kompleks.
- Kredensial (API key, password database) tidak boleh disimpan langsung di kode, melainkan melalui environment variable (`.env`) yang tidak diunggah ke repository.

## 6.4 Proses Sprint & Definition of Done
| Tahapan | Kesepakatan |
|---|---|
| Durasi sprint | 1–2 minggu per sprint, mengacu pada prioritas Must Have di Product Backlog terlebih dahulu |
| Sprint planning | Menentukan user story yang dikerjakan pada sprint berjalan bersama Product Owner |
| Daily check-in | Update singkat progres via grup WhatsApp/Notion setiap hari kerja |
| Sprint review | Demo fitur yang selesai di akhir sprint kepada seluruh anggota tim |
| Definition of Ready | User story memiliki deskripsi jelas dan Acceptance Criteria sebelum masuk sprint |
| Definition of Done | Fitur telah lolos pengujian terhadap Acceptance Criteria, telah direview kode-nya, dan berjalan tanpa error kritis di staging environment |

## 6.5 Testing & Kualitas
- Setiap fitur baru wajib diuji terhadap Acceptance Criteria terkait sebelum dianggap selesai.
- Bug/isu yang ditemukan dicatat di papan kanban dengan tingkat prioritas (kritis/menengah/rendah) dan ditindaklanjuti sebelum rilis berikutnya.
- Pengujian mencakup alur inti: registrasi, katalog & filter, serta booking & pembayaran.

## 6.6 Resolusi Isu Teknis
Perbedaan pendapat terkait keputusan teknis (arsitektur, pemilihan tools, struktur data) diselesaikan melalui diskusi antara Product Owner dan Technical Lead, dengan mempertimbangkan kelayakan implementasi dan kebutuhan pengguna sesuai SRS. Keputusan akhir yang bersifat teknis murni berada pada Technical Lead.

## 6.7 Persetujuan
Dengan menyetujui dokumen ini, seluruh anggota tim sepakat menjalankan proses pengembangan website Maternity.id sesuai kesepakatan teknis di atas.
| Nama | Peran Teknis | Tanda Tangan |
|---|---|---|
| Ayu Saniatus Sholihah | Product Owner / UI-UX | |
| Helmi Arrafif Kanahaya | Technical Lead | |
| Fatwa Isnaya Echa Anastasya | Domain Content Reviewer / QA | |
| Hasna Salsabila | Domain Content Reviewer / QA | |
| Nadila Putri Novitasari Arrahmah | Domain Content Reviewer / QA | |
