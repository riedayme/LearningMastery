<?php if (!empty($midtrans) OR $site['payment_method'] == 'Midtrans' AND !empty($site['page_type']) AND $site['page_type'] == 'payment'): ?>
	<?php if ($site['payment_midtrans']['status_production'] == 'Yes'): ?>
		<script src="https://app.midtrans.com/snap/snap.js" data-client-key="<?php echo $site['payment_midtrans']['client_key'] ?>"></script>	
	<?php endif ?>
	<?php if ($site['payment_midtrans']['status_production'] == 'No'): ?>	
		<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="<?php echo $site['payment_midtrans']['client_key'] ?>"></script>
	<?php endif ?>
<?php endif ?>

<?php if ($site['cookie_notification']['status'] == 'Yes'): ?>
	<link rel="stylesheet" href="<?php echo base_url('storage/plugins-f/cookieconsent/cookieconsent.min.css') ?>"/> 
	<script src="<?php echo base_url('storage/plugins-f/cookieconsent/cookieconsent.min.js') ?>"></script>
	<script>
		window.cookieconsent.initialise({
			"palette": {
				"popup": {
					"background": "#383b75"
				},
				"button": {
					"background": "#f1d600"
				}
			},
			"content": {
				"message": "<?php echo $site['cookie_notification']['message'] ?>",
				"dismiss": "<?php echo $this->lang->line('accept') ?>",
				"link": "<?php echo $this->lang->line('learn_more') ?>"
			}
		});
	</script>
<?php endif ?>

<?php if ($site['google_recaptcha']['status'] == 'Yes' AND $this->router->method == 'register'): ?>
	<script src='https://www.google.com/recaptcha/api.js'></script>
	<script>
		window.onload = function() {
			var $recaptcha = document.querySelector('#g-recaptcha-response');

			if($recaptcha) {
				$recaptcha.setAttribute("required", "required");
			}
		};
	</script>
	<style>
		#g-recaptcha-response {
			display: block !important;
			position: absolute;
			margin: -78px 0 0 0 !important;
			width: 302px !important;
			height: 76px !important;
			z-index: -999999;
			opacity: 0;
		}    
	</style>
<?php endif ?>