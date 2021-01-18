<!doctype html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport"
		  content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Cursos</title>
	<link href="<?php echo base_url('node_modules/bootstrap/dist/css/bootstrap.min.css');?>" type="text/css" rel="stylesheet">

</head>
<body>
<div class="container py-4">
	<div class="row">
		<div class="col-12">
			<h3>Cursos</h3>
			<hr>
			<a class="btn btn-success btn-sm" href="<?php echo base_url('curso/nuevo')?>">Crear curso</a>
			<hr>

			<!-- inicio mensaje -->
			<?php $this->load->view('template/alerta', array()); ?>
			<!-- fin mensaje -->

			<?php if(!empty($cursos)) { ?>
			<table class="table table-hover">
				<thead>
				<tr>
					<th>ID</th>
					<th>Nombre</th>
					<th>Imagen</th>
					<th>Opciones</th>
				</tr>
				</thead>
				<tbody>
				<?php
				foreach ($cursos as $curso) {
					$curso = (Object) $curso;
						?>
						<tr>
							<td><?php echo $curso->id ?></td>
							<td><?php echo $curso->nombre ?></td>
							<td>
								<?php  $imagen = $curso->imagen? $curso->imagen : 'default.jpg'; ?>
								<img style="width: 100px; height: auto" src="<?php echo base_url('assets/img/'.$imagen)?>">
							</td>
							<td>
								<div class="btn-group" role="group">
									<a class="btn btn-info btn-sm" href="<?php echo base_url('/curso/editar/' . $curso->id) ?>">Editar</a>
									<a class="btn btn-warning btn-sm" href="<?php echo base_url('/curso/eliminar/' . $curso->id) ?>">Eliminar</a>
								</div>
							</td>
						</tr>
						<?php
					}
				?>
				</tbody>
			</table>
			<?php } else {
				?>
				<div class="alert alert-warning">
					<p>No existen registros para mostrar</p>
				</div>
			<?php
			} ?>
		</div>
	</div>
</div>
</body>
</html>
