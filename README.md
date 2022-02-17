# Learning Mastery :trophy:
Learning Management System use CodeIgniter3

![Riedayme](https://github.com/riedayme/LearningMastery/blob/main/preview.png?raw=true)

## Fitur Umum yang tersedia

Fitur Umum yang tersedia
* 3 Hak Akses terdiri dari App (admin), Instructor (LMS), dan User (LMS)
* Sitemap Otomatis
* Feeds
* Meta Tags dan Schema Otomatis
* Pengaturan robots.txt
* Pengaturan ads.txt
* Pengaturan Tampilan situs dilakukan dihalaman app
* Halaman Statis
* Registrasi User dengan validasi email

Fitur LMS yang tersedia
* Masuk / Daftar User menggunakan akun sosial
* Pengaturan dilakukan di halaman app (admin)
* Filter pencarian
* Memberi ulasan pada materi
* Dapat menandai materi pembelajaran yang sudah selesai
* Wishlist (daftar keinginan) untuk User
* Pembayaran dilakukan secara manual / menggunakan payment gateway (midtrans)
* Mengubah kode template langsung melalui halaman app

Fitur Blog yang tersedia
* Pemberian kategori dan tags langsung dihalaman post
* Terdapat 2 Template yang dapat digunakan
* Pengaturan Widget melalui halaman app 
* Memasukan kode iklan melalui halaman app 
* Komentar disqus / sistem (bawaan)
* Mengubah kode template langsung melalui halaman app

## Langkah Awal Memulai

### Persyaratan
[CodeIgniter Server Requirements](https://codeigniter.com/userguide3/general/requirements.html)

Intruksi dibawah ini akan ***mengarahkan anda untuk menjalankan project pada komputer anda (local)*** dan ditujukan hanya untuk melakukan development dan testing saja.

### Menjalankan Aplikasi Menggunakan XAMPP

```
Pastikan anda sudah menjalankan module xampp yaitu apache server dan mysql.
***Download Project ini dan extract*** di folder htdocs yang ada pada xampp.
```

***Buat Database dengan nama kurteyki*** di phpmyadmin, silahkan akses url dibawah ini untuk membuka phpmyadmin :

```
http://localhost/phpmyadmin
```

Kemudian ***import kurteyki.sql*** yang ada ddidalam project ini

Langkah kedua ***akses url dibawah ini*** :

```
http://localhost/kurteyki
```

Cron untuk kirim email

```
*/2 * * * * /usr/local/bin/php /home/cpanelusername/public_html/index.php my_jobs listen
```

Pengaturan .htaccess
```
.htaccess.dev = untuk development
.htaccess.run = untuk production

***htaccess ini penting untuk noindex dan caching.***
```

Informasi App

```
Halaman Login : http://localhost/kurteyki/auth

Default App login
username : kurteyki
password: kurteyki

```

## Sumber Inspirasi

* CiFireCMS (module blog dan pengaturan situs)
* Academy by Creativeitem (module lms)
* buildwithangga.com (module pembayaran manual)
* skillacademy.com (template lms)
* cms.botble.com (module pengaturan smtp dan statistik visitor)

## Lisensi

[![License: CC BY 4.0](https://i.creativecommons.org/l/by/4.0/88x31.png)](https://creativecommons.org/licenses/by/4.0/)<br/>
This work is licensed under a [Creative Commons Attribution 4.0 International License](http://creativecommons.org/licenses/by/4.0/).