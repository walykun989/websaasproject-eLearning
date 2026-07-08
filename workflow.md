# Website SaaS E-Learning: Waktu Informatika Belajar (WIB)

## Deskripsi Sistem

Website Waktu Informatika Belajar (WIB) merupakan sistem yang digunakan untuk menampilkan informasi e-learning, katalog produk (kelas), serta melayani transaksi pembelian secara online.

Sistem memiliki tiga jenis pengguna:

1. **Admin**
2. **Pengajar**
3. **User (Peserta)**

Metode pembayaran menggunakan **transfer bank manual**, sehingga setiap pembayaran harus diverifikasi oleh Admin sebelum pesanan diproses.

---

# Workflow Sistem

## Alur Utama

```text
Pengunjung
    │
    ▼
Melihat Katalog Produk (Kelas)
    │
    ▼
Registrasi / Login
    │
    ▼
Akses Materi (Tier Free)
    │
    ▼
Melakukan Pembelian (Langganan SaaS)
    │
    ▼
Upload Bukti Transfer
    │
    ▼
Verifikasi Admin
    │
    ▼
Akses Penuh & Wajib Review
    │
    ▼
Pesanan Selesai (Sertifikat Terbit)
```

---

# Role User (Peserta)

## Hak Akses User

* [x] Registrasi akun
* [x] Login
* [x] Mengelola profil (termasuk custom border & tema)
* [x] Melihat katalog produk (kelas)
* [x] Mengakses materi belajar
* [x] Melakukan checkout (langganan)
* [x] Upload bukti transfer
* [x] Memberikan review wajib
* [x] Melihat status pesanan (status tier)
* [x] Melihat riwayat transaksi
* [x] Mendownload sertifikat kelulusan

---

## Workflow Registrasi

```text
Masuk Website
    │
    ▼
Klik Registrasi
    │
    ▼
Mengisi Data Diri
    │
    ├─ Nama Lengkap
    ├─ Email
    ├─ Password
    └─ Konfirmasi Password
    │
    ▼
Simpan
    │
    ▼
Akun Berhasil Dibuat
```

---

## Workflow Login

```text
Masuk Website
    │
    ▼
Login
    │
    ├─ Email
    └─ Password
    │
    ▼
Dashboard User
```

---

## Workflow Kelola Profil

```text
Dashboard User
    │
    ▼
Profil Saya
    │
    ├─ Edit Nama
    ├─ Edit Email
    ├─ Ganti Password
    └─ Custom Tema (Apik/Sangar)
    │
    ▼
Simpan Perubahan
```

---

## Workflow Pembelian Produk (Langganan)

```text
Melihat Produk (Katalog Kelas)
    │
    ▼
Memilih Produk (Materi Terkunci)
    │
    ▼
Diarahkan ke Paywall / Harga Tier
    │
    ▼
Pilih Tier (Apik / Sangar)
    │
    ▼
Checkout
```

---

## Workflow Checkout

```text
Checkout
    │
    ▼
Sistem Menghitung Total Belanja (Rp 12.345 / Rp 67.891)
    │
    ▼
Menampilkan Rekening Perusahaan
    │
    ▼
User Melakukan Transfer
    │
    ▼
Upload Bukti Transfer
    │
    ▼
Status:
Menunggu Verifikasi Admin
```

---

## Workflow Tracking Pesanan (Status Tier)

```text
Pesanan Saya
    │
    ▼
Melihat Status Pesanan
```

### Status Pesanan

1. Menunggu Pembayaran
2. Menunggu Verifikasi
3. Pembayaran Ditolak
4. Pembayaran Diterima (Tier Aktif)
5. Dibatalkan

---

## Workflow Review & Sertifikat

```text
Selesaikan Semua Materi (Aksesibel)
    │
    ▼
Tombol Review Aktif
    │
    ▼
Beri Rating (1-5) & Komentar (min 10 karakter)
    │
    ▼
Review Tersimpan
    │
    ▼
Sertifikat Dapat Diterbitkan
    │
    ▼
Generate & Download Sertifikat (PDF)
    │
    ▼
Selesai
```

### Ketentuan:
* Review hanya bisa diberikan 1 kali per user per course
* Review hanya aktif setelah semua materi (yang bisa diakses) selesai
* Sertifikat hanya bisa diterbitkan jika review sudah diberikan
* Sertifikat hanya 1 per user per course

---

# Role Pengajar

## Hak Akses Pengajar

* Login Pengajar
* Mengelola Profil
* Membuat Kelas Baru
* Menambah Materi (Video/Teks)
* Melihat Ulasan Peserta
* Mengelola Sesi Privat (Tier Sangar)

---

## Workflow Kelola Kelas & Materi

```text
Dashboard Pengajar
    │
    ▼
Kelola Kelas
    │
    ├─ Tambah Kelas Baru
    ├─ Kelola Materi Kelas
    │    ├─ Input Link Video
    │    └─ Input Teks
    └─ Lihat Review Peserta
    │
    ▼
Simpan
```

---

# Role Admin

## Hak Akses Admin

* Login Admin
* Mengelola Kategori Produk (Kelas)
* Mengelola Produk (Daftar Semua Kelas)
* Mengelola User
* Verifikasi Pembayaran
* Mengelola Laporan

---

## Workflow Login Admin

```text
Login Admin
    │
    ▼
Dashboard Admin
```

---

## Workflow Kelola Kategori Produk

```text
Kategori Produk
    │
    ├─ Tambah Kategori
    ├─ Edit Kategori
    └─ Hapus Kategori
```

---

## Workflow Kelola User

```text
Data User
    │
    ├─ Lihat User
    ├─ Cari User
    ├─ Detail User
    ├─ Nonaktifkan User
    └─ Aktifkan User
```

---

## Workflow Verifikasi Pembayaran

```text
Pesanan Masuk
    │
    ▼
Lihat Bukti Transfer
    │
    ▼
Verifikasi Pembayaran
    │
    ├─ Valid
    │    │
    │    ▼
    │  Pembayaran Diterima (Akses Tier Terbuka)
    │
    └─ Tidak Valid
         │
         ▼
      Pembayaran Ditolak
```

---

## Workflow Laporan

```text
Dashboard
    │
    ▼
Laporan
    │
    ├─ Penjualan Harian
    ├─ Penjualan Bulanan
    ├─ Penjualan Tahunan
    ├─ Data Customer
    └─ Total Pendapatan
```

---

# Struktur Menu User

```text
Home
├── Beranda
├── Katalog Kelas
├── My Learning
├── Checkout
├── Riwayat Transaksi
├── Profil Saya
└── Logout
```

---

# Struktur Menu Pengajar

```text
Dashboard
├── Kelola Kelas
├── Ulasan Peserta
├── Sesi Privat
├── Profil Saya
└── Logout
```

---

# Struktur Menu Admin

```text
Dashboard
├── Kategori Produk (Kelas)
├── Data Kelas
├── Pembayaran
├── User
├── Laporan
└── Logout
```