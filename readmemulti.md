# OPENSID Multiple

------

openSID Multiple adalah Sistem Informasi Desa yang berisi beberapa desa sekaligus. repo utama opensid berjalan dengan skema 1 aplikasi 1 desa. Pada repo ini 1 aplikasi banyak desa. repo ini berawal dari bimbingan pak [Ahmad Afandi](https://github.com/pandigresik) pada video youtubenya di [Trik Satu OpenSID untuk banyak desa](https://www.youtube.com/watch?v=qfgv-Du5oRE) dengan beberapa penyesuaian config.

#### Rekap penyesuaian config pada source code opensid

- file index.php

  kode awal

  ```php
   define('FCPATH', dirname(__FILE__).DIRECTORY_SEPARATOR);
  ```

  kode perubahan

  ```php
  $namaDesa=end(explode(DIRECTORY_SEPARATOR,$_SERVER['DOCUMENT_ROOT']));
  define('FCPATH', dirname(__FILE__). '/sites-desa/'. $namaDesa.DIRECTORY_SEPARATOR);
  ```

- file donjo-app/models/Surat_model.php 

  fungsi sisipkan_logo

  ```php
  $file_logo = APPPATH . '../' . LOKASI_LOGO_DESA . $nama_logo;
  ```

  menjadi

  ```php 
  $file_logo = FCPATH . LOKASI_LOGO_DESA . $nama_logo;
  ```



​		fungsi sisipkan_foto

```php
$file_foto = APPPATH . '../' . LOKASI_USER_PICT . $nama_foto;
```

​		menjadi

```php
$file_foto = FCPATH . LOKASI_USER_PICT . $nama_foto;
```



- --------------



