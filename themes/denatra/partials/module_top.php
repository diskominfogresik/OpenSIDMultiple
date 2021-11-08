<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php $this->load->view('global/validasi_form', ['web_ui' => true]); ?>
<script src="<?= base_url()?>assets/js/highcharts/sankey.js"></script>
<script src="<?= base_url()?>assets/js/highcharts/organization.js"></script>
<script src="<?= base_url()?>assets/js/highcharts/accessibility.js"></script>
<link rel="stylesheet" href="<?= base_url()?>assets/css/mapbox-gl.css" />
<?php if ($this->uri->segment(1) == 'peta'): ?>
<link rel="stylesheet" href="<?= base_url()?>assets/css/peta.css">
<?php endif; ?>
<script src="<?= base_url()?>assets/js/mapbox-gl.js"></script>
<script src="<?= base_url()?>assets/js/leaflet-mapbox-gl.js"></script>
<script src="<?= base_url()?>assets/js/peta.js"></script>

<link rel="stylesheet" href="<?= base_url("$this->theme_folder/$this->theme/assets/css/bootstrap-lazy-load.css") ?>">
<link rel="stylesheet" href="<?= base_url("$this->theme_folder/$this->theme/assets/css/widget.min.css") ?>">
<script src="<?= base_url("$this->theme_folder/$this->theme/assets/js/widget.js?" . THEME_VERSION) ?>"></script>
