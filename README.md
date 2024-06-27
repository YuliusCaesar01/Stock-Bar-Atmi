# StockBar (SB)

<p align="center">
  <img src="public/logopt.png" alt="Logo SB">
</p>

**Aplikasi web untuk melacak laporan gudang dan menarik data ke aplikasi utama**

StockBar (SB) adalah aplikasi web yang dibangun dengan framework Laravel yang menyediakan informasi Stok Item pada Perusahaan. Proyek ini bertujuan untuk memberikan pengalaman yang mulus dan efektif bagi pengguna untuk melacak laporan gudang dan menarik data ke aplikasi utama.

## Fitur

* Pengambilan dan visualisasi data saham real-time.
* Antarmuka yang ramah pengguna untuk mengelola portofolio saham.
* Pemberitahuan kustom untuk perubahan harga dan tren pasar.
* Analisis dan wawasan terperinci untuk pengambilan keputusan yang terinformasi.
* Otentikasi aman dan manajemen akun pengguna.

## Memulai

**Instalasi:**

```bash
#!/bin/bash

git clone [https://github.com/AimLesson/SB.git](https://github.com/AimLesson/SB.git) && \

cd SB && \
composer install && \

cp .env.example .env && \
php artisan key:generate && \

php artisan migrate --seed && \

php artisan serve
