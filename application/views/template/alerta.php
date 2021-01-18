<?php if (isset($mensaje)) {
	?>
	<div class="alert alert-success alert-dismissible">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		<h4><i class="icon fa fa-check"></i> Mensaje</h4>
		<p><?php echo $mensaje;?></p>
	</div>
	<?php
	$this->session->unset_userdata('mensaje');
} elseif (isset($error)) {
	?>
	<div class="alert alert-danger alert-dismissible">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		<h4><i class="icon fa fa-ban"></i> Error</h4>
		<p><?php echo $error;?></p>
	</div>
	<?php
	$this->session->unset_userdata('error');
}?>
