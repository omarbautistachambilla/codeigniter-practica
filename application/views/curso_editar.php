<!doctype html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport"
		  content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link href="<?php echo base_url('node_modules/bootstrap/dist/css/bootstrap.min.css');?>" type="text/css" rel="stylesheet">
	<title>Curso editar</title>
</head>
<body>
<div class="container py-4">
	<div class="row">
		<div class="col-12">
			<h3>Curso: editar</h3>
			<hr>
			<a class="btn btn-success btn-sm" href="<?php echo base_url('/curso/nuevo');?>">Nuevo curso</a>
			<a class="btn btn-info btn-sm" href="<?php echo base_url('/cursos');?>">Listar</a>
			<hr>

			<!-- inicio mensaje -->
			<?php $this->load->view('template/alerta', array()); ?>
			<!-- fin mensaje -->

			<form action="<?php echo base_url('curso/guardar')?>" method="post" enctype="multipart/form-data">
				<div class="mb-3">
					<label class="form-label" for="nombre">Nombre</label>
					<input class="form-control" type="text" name="nombre" id="nombre" placeholder="Nombre" value="<?php echo set_value('nombre', $curso->nombre);?>">
				</div>

				<div class="mb-3">
					<label class="form-label" for="imagen">Imagen</label>
					<input class="form-control" type="file" name="imagen" id="imagen">
				</div>

				<div class="mb-3">
					<input type="hidden" name="guardar" value="EDICION">
					<input type="hidden" name="curso_id" value="<?php echo $curso->id;?>">
					<input type="hidden" name="imagen" value="<?php set_value($curso->imagen);?>">
					<button type="submit" class="btn btn-success btn-block">Guardar</button>
				</div>
			</form>
		</div>
	</div>
</div>
</body>
</html>
