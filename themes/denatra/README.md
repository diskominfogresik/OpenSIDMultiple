<h1 align="center">Selamat datang di Tema DeNatra!</h1>

## Tema DeNatra
Tema DeNatra https://www.natairaya.desa.id adalah salah satu Tema yang digunakan untuk halaman Website OpenSID (Sistem Informasi Desa).

Tema ini dibuat oleh Ariandi Ryan Kahfi, S.Pd. dengan mengangkat nama Desa Natai Raya yang disingkat menjadi DeNatra.

Sebelumnya ada Tema Natra (https://github.com/OpenSID/tema-natra) kependekan dari Natai Raya yang merupakan pemenang Sayembara Tema Web OpenSID 2019.

## Sesuaikan Kode Aktivasi (tidak berlaku bagi pengguna baru)
Khusus pengguna DeNatra sebelum v4.1 silakan edit file `desa/config/config.php`.

$config['denatra'] = "kode_aktivasi";

Kata 'denatra' yang tertulis diubah menjadi 'DeNatra'

## Tampilkan Halaman Penuh
Salin kode di bawah ini ke dalam file `desa/config/config.php`.

$config['fluid'] = 'y';

## Pengaturan Jadwal Sholat
Salin kode di bawah ini ke dalam file `desa/config/config.php`.

$config['kode_kota'] = "2207";

List kode kota bisa lihat di https://www.natairaya.desa.id/kode

## Keterangan Lapak (Manual)
- Ubah Produk menu Lapak, edit file: desa/themes/denatra/lapak.json dengan keterangan sebagai berikut:

	"aktif": false, (ubah dari false menjadi true untuk menampilkan Lapak Desa Manual)

	"id": "1", (ini harus urut jika menambah produk)

	"gambar": "lele.jpg", (gambar yang ada di folder desa/themes/denatra/assets/lapak)

	"hp": "628115222660", (nomor Hp Pelapak)

	"lat": "-2.665093", (Titik koordinat Latitude)

	"lng": "111.709899", (Titik koordinat Langitude)

- Tampilan bisa berupa gambar, mp4, ataupun embed dari Youtube

## Pengaturan Fitur Komentar Facebook
Salin kode di bawah ini ke dalam file `desa/config/config.php`.

$config['fbadmin'] = "1117950751";

$config['fbappid'] = "147912828718";

Silakan ganti dengan ID Profil Akun Facebook Anda.

Petunjuknya di (https://www.natairaya.desa.id/artikel/2019/1/30/memasang-komentar-facebook-di-sistem-informasi-desa)

## Keterangan Tambahan
- Ubah Logo OpenSID saat bagikan link web utama, ganti file: desa/themes/denatra/assets/image/logo.png
- Ubah Background Header, ganti file: desa/themes/denatra/assets/img/header.jpg
- Sesuaikan tampilan header (misal ganti tombol WA dan Facebook), edit file: desa/themes/denatra/commons/header.php (baris 109 dan 110)
- Sesuaikan tampilan widget di halaman utama bagian bawah, bisa edit file: desa/themes/denatra/partials/module_home.php

	ganti file php yang ada di $data["isi"] sesuai dengan nama file widget yang ingin ditampilkan. (baris 94, 99, 104, dan 109)

	(secara default ada 4 widget, statistik.php, peta_wilayah_desa.php, peta_lokasi_kantor.php dan komentar.php)

- Ingin menambah script pada bagian meta web, edit file: desa/themes/denatra/partials/module_top.php
- Ingin menambah script pada bagian footer web, edit file: desa/themes/denatra/partials/module_bottom.php
- Sesuaikan sidebar kanan atau kiri, edit file: desa/themes/denatra/commons/sidebar.php
- Sesuaikan tinggi slider, edit file: desa/themes/denatra/layouts/slider.php baris ke 27 (style="max-height: 350px;") sesuaikan angka yg diinginkan, misal 450px
- sesuaikan link tujuan dan link gambar pada Shortcut/Banner di halaman utama, edit file: desa/themes/denatra/partials/banner.php
- Munculkan icon statistik pengunjung di header Hp, edit file: desa/themes/denatra/commons/header.php baris ke 20 (hapus text-hide-xs didalam class nya)
