<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<style>
#footer{
  background-color:#142850;
}
.backTop {
	position: fixed;
	bottom: 0;
	left: 0;
	display: inline-block;
	padding: 0.5em;
	margin: 0.5em;
}
.backTop:hover {
	cursor: pointer;
}
</style>
<script>
$(window).on('load', function() {
    $('.backTop').hide();
	$(window).scroll(function() {
		if ($(this).scrollTop() > 100) {
			$(".backTop").fadeIn();
		} else {
			$(".backTop").fadeOut();
		}
	});
	$('.backTop').click(function() {
		$("html, body").animate({scrollTop: 0}, 500);
	});
});
</script>
<script src="https://rawgit.com/toddmotto/echo/master/dist/echo.js"></script>
<script src="<?= base_url("$this->theme_folder/$this->theme/assets/js/bootstrap-lazy-load.js"); ?>"></script>
<script src="<?= base_url("$this->theme_folder/$this->theme/assets/js/sweetalert2.all.min.js"); ?>"></script>
<div class="backTop z-index-1"><i class="fa fa-chevron-circle-up fa-3x"></i></div>
