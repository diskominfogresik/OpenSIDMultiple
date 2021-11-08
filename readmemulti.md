# OPENSID Multiple

------

openSID Multiple adalah Sistem Informasi Desa yang berisi beberapa desa sekaligus. repo utama opensid berjalan dengan skema 1 aplikasi 1 desa. Pada repo ini 1 aplikasi banyak desa. repo ini berawal dari bimbingan pak [Ahmad Afandi](https://github.com/pandigresik) pada video youtubenya di [Trik Satu OpenSID untuk banyak desa](https://www.youtube.com/watch?v=qfgv-Du5oRE) dengan beberapa penyesuaian config.

#### Rekap penyesuaian config pada source code opensid

- file donjo-app/controllers/Database.php

  kode awal

  

  kode perubahan
  
  ```php
  $namaDesa=end(explode(DIRECTORY_SEPARATOR,$_SERVER['DOCUMENT_ROOT']));
  $backup_folder = FCPATH.'sites-desa/'. $namaDesa . '/' .'desa/'; // Folder yg akan di backup  
  ```

- file donjo-app/config/config.php

  

- file donjo-app/config/sid_ini.php

- file donjo-app/helpers/opensid_helpers.php



