# OPENSID Multiple

------

openSID Multiple adalah Sistem Informasi Desa yang berisi beberapa desa sekaligus. repo utama opensid berjalan dengan skema 1 aplikasi 1 desa. Pada repo ini 1 aplikasi banyak desa. repo ini berawal dari bimbingan pak [Ahmad Afandi](https://github.com/pandigresik) pada video youtubenya di [Trik Satu OpenSID untuk banyak desa](https://www.youtube.com/watch?v=qfgv-Du5oRE)  dan repo nya [opensid_multisite](https://github.com/pandigresik/opensid-multisite) dengan beberapa penyesuaian config. Untuk versi 22.07, setelah download source code 22.07, ikuti tutorial yang ada di repository [opensid_multisite](https://github.com/pandigresik/opensid-multisite) , kemudian lakukan konfigurasi berikut

#### Rekap penyesuaian config pada source code opensid

- file donjo-app/core/MY_Controller.php

  Tukar kode baris 71 dan 72

  kode awal

  ```php
  $this->header     = $this->config_model->get_data();
  $this->setting_model->init();			
  ```

  kode perubahan

  ```php
  $this->setting_model->init();	
  $this->header     = $this->config_model->get_data();
  ```

  

- file  donjo-app/models/Web_artikel_model.php

  baris 451 dikomen (di fungsi hapus)

  ```php
  //  ->where()
  ```

  baris 459 diganti

  kode awal

  ```php
   $outp = $this->db->where('a.id', $id)->delete('artikel a');
  ```

  kode akhir

  ```php
   $outp = $this->db->where('id', $id)->delete('artikel');
  ```

  

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



