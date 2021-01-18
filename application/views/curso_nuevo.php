<!doctype html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport"
		  content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Curso nuevo</title>
	<link href="<?php echo base_url('node_modules/bootstrap/dist/css/bootstrap.min.css') ?>" type="text/css" rel="stylesheet">
</head>
<body>
	<div class="container py-4">
		<div class="row">
			<div class="col-12">
				<h3>Curso: nuevo</h3>
				<hr>
					<a class="btn btn-info btn-sm" href="<?php echo base_url('/cursos') ?>"> Listar</a>
				<hr>
				<!-- inicio mensaje -->
				<?php $this->load->view('template/alerta', array()); ?>
				<!-- fin mensaje -->

				<form action="<?php echo base_url('curso/guardar')?>" method="post">
					<div class="mb-3">
						<label class="form-label" for="nombre">Nombre</label>
						<input class="form-control" type="text" name="nombre" id="nombre" placeholder="Nombre" value="<?php echo set_value('nombre');?>">
					</div>
					<div class="mb-3">
						<input type="hidden" name="guardar" value="NUEVO">
						<button type="submit" class="btn btn-success btn-block">Guardar</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</body>
</html>
