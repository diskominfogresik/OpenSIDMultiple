<h1 align="center">Selamat datang di Tema DeNatra!</h1>

## Tema DeNatra
Tema DeNatra https://www.natairaya.desa.id adalah salah satu Tema yang digunakan untuk halaman Website OpenSID (Sistem Informasi Desa).

Tema ini dibuat oleh Ariandi Ryan Kahfi, S.Pd. dengan mengangkat nama Desa Natai Raya yang disingkat menjadi DeNatra.

Sebelumnya ada Tema Natra (https://github.com/OpenSID/tema-natra) kependekan dari Natai Raya yang merupakan pemenang Sayembara Tema Web OpenSID 2019.

## Tampilkan Halaman Penuh
Salin kode di bawah ini ke dalam file `desa/config/config.php`.

$config['fluid'] = true;

## Tampilkan Menu Statis di Header
Salin kode di bawah ini ke dalam file `desa/config/config.php`.

$config['menu'] = true;

## Pengaturan Jadwal Sholat dan Komentar Facebook
Salin kode di bawah ini ke dalam file `desa/config/config.php`.

$config['kode_kota'] = '2207';

$config['fbadmin'] = '1117950751';

$config['fbappid'] = '147912828718';

List kode kota bisa lihat di https://www.natairaya.desa.id/kode

Cara mengganti ID Profil Akun Facebook di (https://www.natairaya.desa.id/artikel/2019/1/30/memasang-komentar-facebook-di-sistem-informasi-desa)

## Fitur Lapak (Manual)
- Ubah Produk menu Lapak, edit file: desa/themes/denatra/partials/lapak/lapak.json dengan keterangan sebagai berikut:

	"aktif": false, (ubah false menjadi true untuk menampilkan Lapak Desa bawaan tema)

	"id": "1", (ini harus urut jika menambah produk)

	"gambar": "lele.jpg", (gambar yang ada di folder desa/themes/denatra/assets/lapak)

	"hp": "628115222660", (nomor Hp Pelapak)

	"lat": "-2.665093", (Titik koordinat Latitude)

	"lng": "111.709899", (Titik koordinat Langitude)

- Tampilan bisa berupa gambar, mp4, ataupun embed dari Youtube

## Keterangan Tambahan
- Ubah Logo OpenSID saat bagikan link web utama, ganti file: desa/themes/denatra/assets/image/logo.png
- Ubah Background Header, ganti file: desa/themes/denatra/assets/img/header.jpg
- Sesuaikan tampilan header (misal ganti tombol WA dan Facebook), edit file: desa/themes/denatra/commons/header.php (baris 106 dan 107)
- Sesuaikan tampilan widget di halaman utama bagian bawah, bisa edit file: desa/themes/denatra/partials/module_home.php

	ganti file php yang ada di $data["isi"] sesuai dengan nama file widget yang ingin ditampilkan. (baris 81, 86, 91, dan 96)

	(secara default ada 4 widget, statistik.php, peta_wilayah_desa.php, peta_lokasi_kantor.php dan komentar.php)

- Ingin menambah script pada bagian meta web antara <head> dan </head>, edit file: desa/themes/denatra/partials/module_top.php
- Ingin menambah script pada bagian footer web, edit file: desa/themes/denatra/partials/module_bottom.php
- Sesuaikan sidebar kanan atau kiri, edit file: desa/themes/denatra/commons/sidebar.php
- Sesuaikan tinggi slider, edit file: desa/themes/denatra/layouts/slider.php baris ke-25 (max-height: 350px dan 450px) sesuaikan angka yg diinginkan
- sesuaikan link tujuan dan link gambar pada Shortcut/Banner di halaman utama, edit file: desa/themes/denatra/partials/home/banner.php
- Munculkan icon statistik pengunjung di header Mobile View, edit file: desa/themes/denatra/commons/header.php baris ke-19 (hapus text-hide-xs didalam class nya)
- Menghilangkan loading pada saat membuka website, edit dan sesuaikan isi file: desa/themes/denatra/commons/loader.php
