## 📝 Deskripsi
Praktikum ini berfokus pada implementasi fitur keamanan dasar pada aplikasi web berbasis PHP OOP. [cite_start]Tujuan utamanya adalah membatasi akses ke halaman tertentu (seperti halaman CRUD Artikel) hanya untuk pengguna yang sudah terautentikasi (Login) dan menerapkan manajemen Session [cite: 4-6].

## 🚀 Fitur yang Dibuat
1.  **Autentikasi User:** Fitur Login menggunakan password yang terenkripsi (*hashing*).
2.  **Session Management:** Mengelola sesi pengguna agar sistem mengenali user yang sedang aktif.
3.  **Proteksi Halaman:** Mencegah akses langsung ke halaman admin/artikel tanpa login melalui pengecekan di `index.php`.
4.  **Navigasi Dinamis:** Menu Header berubah berdasarkan status login (Login vs Logout).
5.  **Styling:** Penambahan CSS modern untuk mempercantik antarmuka.

---

## 🛠️ Langkah Pengerjaan

### 1. Persiapan Database
[cite_start]Membuat tabel `users` dan memasukkan data user admin dengan password yang di-hash menggunakan `password_hash()` [cite: 13-27].

```sql
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL,
    nama VARCHAR(100)
);
```
<img width="1365" height="552" alt="image" src="https://github.com/user-attachments/assets/d804d6e2-2d31-4a6e-aaa5-24a9e063ef35" />

2. Konfigurasi Routing & Session
Memodifikasi file index.php untuk memulai session_start() dan menambahkan logika pengecekan. Jika user belum login dan mencoba mengakses halaman selain Public Pages, sistem akan me-redirect ke halaman Login .

3. Pembuatan Modul User
Membuat folder module/user/ yang berisi:
login.php: Form login dan logika verifikasi password (password_verify) .
logout.php: Skrip untuk menghancurkan session (session_destroy) .

4. Update UI (Header & CSS)
Mengubah template/header.php agar menu navigasi menjadi dinamis.
Belum Login: Tampil menu "Home" dan "Login".
Sudah Login: Tampil menu "Home", "Data Artikel", dan "Logout (Nama User)" .
<img width="1365" height="767" alt="image" src="https://github.com/user-attachments/assets/8c8ea294-a7cf-46c2-9598-7ed335d86687" />
<img width="1365" height="767" alt="image" src="https://github.com/user-attachments/assets/3981ca82-13a8-4d30-90f7-79bb0d32012a" />
<img width="1365" height="767" alt="image" src="https://github.com/user-attachments/assets/3e7b20b1-b981-43a8-ae41-db4fe0f79f9d" />

# Lanjutan: Praktikum 13 & 14 (Pagination & Pencarian)

## 📝 Deskripsi
Pada tahap ini, aplikasi dikembangkan untuk menangani data dalam jumlah besar. Fitur **Pagination** digunakan untuk memecah tampilan data menjadi beberapa halaman agar tidak menumpuk, sedangkan fitur **Pencarian** (Search) memungkinkan pengguna menemukan artikel tertentu berdasarkan kata kunci.

---

## 🚀 Fitur Baru yang Ditambahkan

### 1. Pagination (Paging) [Praktikum 13]
Fitur ini membatasi jumlah data yang tampil per halaman (contoh: 5 artikel per halaman).
* **Logika:** Menggunakan query SQL `LIMIT` dan `OFFSET`.
* **Navigasi:** Tombol *Previous*, Angka Halaman, dan *Next*.
* **Styling:** Kustomisasi CSS untuk tombol pagination agar terlihat rapi.

### 2. Pencarian Data (Searching) [Praktikum 14]
Fitur untuk memfilter data artikel berdasarkan judul atau konten.
* **Logika:** Menggunakan klausa SQL `WHERE judul LIKE '%keyword%'`.
* **Integrasi:** Pencarian terintegrasi dengan Pagination. Artinya, saat berpindah halaman pada hasil pencarian, kata kunci pencarian tidak hilang (tetap tersimpan di URL dengan `&q=...`).

---

## 🛠️ Langkah Pengerjaan

### A. Persiapan Data (Data Dummy)
Menambahkan kolom `gambar`, `kategori`, `penulis`, dan `tanggal` pada tabel `artikel`, serta memasukkan 12+ data dummy agar fitur pagination terlihat efeknya.

```sql
-- Contoh Query Data Dummy
INSERT INTO artikel (judul, isi, kategori, penulis) VALUES 
('Belajar PHP', '...', 'Programming', 'Agung'),
('Tutorial Bootstrap', '...', 'Frontend', 'Budi'),
... (dan seterusnya sampai 12 data);
```

B. Implementasi Kode (module/artikel/index.php)
Memodifikasi query utama untuk menggabungkan filter pencarian dan batasan halaman.

Snippet Logika Utama:

PHP

// 1. Tangkap Pencarian
$q = $_GET['q'] ?? "";
$where = $q ? " WHERE judul LIKE '%$q%'" : "";

// 2. Konfigurasi Pagination
$limit = 5;
$page = $_GET['page'] ?? 1;
$offset = ($page - 1) * $limit;

// 3. Query Gabungan
$sql = "SELECT * FROM artikel $where LIMIT $offset, $limit";

C. Update UI
Menambahkan Form Pencarian di atas tabel dan navigasi Pagination di bawah tabel menggunakan komponen Bootstrap dan CSS kustom.

<img width="1365" height="767" alt="image" src="https://github.com/user-attachments/assets/ca727ab0-c6fa-4865-8e61-1e3259a4eaa5" />
<img width="1365" height="767" alt="image" src="https://github.com/user-attachments/assets/7d580bf8-690e-4fff-b24e-720087c6db1e" />
<img width="1365" height="767" alt="image" src="https://github.com/user-attachments/assets/99cc7321-c847-4383-8417-24a05c302a95" />
<img width="1363" height="766" alt="image" src="https://github.com/user-attachments/assets/0dba96fd-dfc7-403d-ae9f-8054ad728c32" />





