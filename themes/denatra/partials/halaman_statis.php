<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php if ($this->uri->segment(1) == 'status-idm' OR $this->uri->segment(2) == 'status_idm'): ?>
<?php $this->load->view(Web_Controller::fallback_default($this->theme, '/partials/status_idm.php'));?>
<?php elseif ($this->uri->segment(1) == 'lapak' OR $this->uri->segment(2) == 'lapak'): ?>
<?php $this->load->view(Web_Controller::fallback_default($this->theme, '/partials/lapak.php'));?>
<?php else: ?>
<?php $this->load->view($halaman_statis); ?>
<?php endif; ?>
