# Panduan Deployment ke Railway

Railway adalah platform cloud yang sangat cocok untuk aplikasi PHP + MySQL karena menyediakan keduanya dalam satu tempat.

Berikut adalah langkah-langkah untuk mendeploy aplikasi ini.

## 1. Persiapan Repository

Pastikan kode Anda sudah ada di GitHub (jika belum):

```bash
git init
git add .
git commit -m "Siap deploy ke Railway"
git branch -M main
git remote add origin <URL_REPO_GITHUB_ANDA>
git push -u origin main
```

## 2. Setup di Railway

1. Buka [Railway Dashboard](https://railway.app/).
2. Klik **"New Project"** -> **"Deploy from GitHub repo"**.
3. Pilih repository aplikasi absensi Anda.
4. Klik **"Deploy Now"**.

   > **INFO:** Railway akan otomatis mendeteksi file `Dockerfile` yang baru saja kita buat. Ini akan memastikan aplikasi berjalan dengan PHP 8.2 dan Apache yang sudah dikonfigurasi dengan benar.
   > Jika deployment tidak berjalan otomatis setelah push, buka tab **Settings** -> **Build**, dan pastikan **Builder** mengarah ke **Dockerfile**.

## 3. Menambahkan Database MySQL

1. Di dashboard project Railway Anda, klik tombol **"New"** (atau klik kanan di area kosong).
2. Pilih **Database** -> **MySQL**.
3. Tunggu hingga database selesai dibuat (status hijau).

## 4. Menghubungkan Aplikasi dengan Database

1. Klik pada kartu **MySQL** yang baru dibuat.
2. Buka tab **"Variables"**. Anda akan melihat daftar variabel seperti `MYSQLHOST`, `MYSQLUSER`, `MYSQLPASSWORD`, dll.
3. Tutup kartu MySQL, lalu klik pada kartu **Aplikasi** (repo Anda).
4. Buka tab **"Variables"**.
5. Tambahkan variabel berikut (Anda bisa copy-paste value dari variabel MySQL tadi):

   | Variable Name | Value (Ambil dari MySQL Variables) |
   |---------------|------------------------------------|
   | `DB_HOST`     | `${{MySQL.MYSQLHOST}}` (Reference variable) |
   | `DB_USER`     | `${{MySQL.MYSQLUSER}}` |
   | `DB_PASS`     | `${{MySQL.MYSQLPASSWORD}}` |
   | `DB_NAME`     | `${{MySQL.MYSQLDATABASE}}` |
   | `BASEURL`     | `https://<url-aplikasi-anda>.up.railway.app/public` |

   > **Tips:** Di Railway, Anda bisa mengetik `${{` saat mengisi value untuk mengambil referensi otomatis dari service lain (MySQL). Ini lebih aman daripada copy-paste manual.

   > **PENTING:** Untuk `BASEURL`, tunggu sampai Railway memberikan domain publik (lihat langkah 5), lalu isi dengan format: `https://domain-anda.up.railway.app/public`.

## 5. Mengakses Aplikasi

1. Di kartu **Aplikasi**, buka tab **"Settings"**.
2. Di bagian **Networking**, klik **"Generate Domain"**.
3. Salin domain yang muncul, lalu update variabel `BASEURL` di tab Variables tadi.
4. Aplikasi akan redeploy otomatis.

## 6. Import Database

1. Klik kartu **MySQL**.
2. Buka tab **"Data"** (jika ada) atau gunakan tab **"Connect"** untuk melihat kredensial.
3. Gunakan aplikasi database manager di laptop Anda (seperti DBeaver, HeidiSQL, atau TablePlus).
4. Koneksikan ke database Railway menggunakan kredensial yang ada di tab "Connect".
5. Import file `aabw_absensi.sql` dari project Anda ke database tersebut.

## Catatan Penting

- **File Upload**: Sama seperti Vercel, Railway menggunakan sistem file ephemeral. File yang diupload ke folder `public/uploads` akan hilang setiap kali Anda redeploy. Disarankan menggunakan layanan storage eksternal (Cloudinary/S3) untuk produksi.
- **Dockerfile**: Saya sudah menambahkan `Dockerfile` yang dikonfigurasi khusus untuk aplikasi ini (PHP 8.2 + Apache + mod_rewrite). Railway akan menggunakannya otomatis.
