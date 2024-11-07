<!DOCTYPE html>
<html>
	<head>
		<?php $this->load->view($head_view); ?>
	</head>
	<body>
		<div class="container">
			<?php $this->load->view($header_view); ?>
			<?php if($center_view) $this->load->view($center_view); ?>
			<?php $this->load->view($footer_view); ?>
		</div>
		<?php $this->load->view($foot_view); ?>
	</body>
</html>
