<?php

class Curso extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('curso_model');
	}

	public function index()
	{
		// mensajes
		if ($this->session->flashdata('mensaje')) {
			$data['mensaje'] = $this->session->flashdata('mensaje');
		} elseif ($this->session->flashdata('error')) {
			$data['error'] = $this->session->flashdata('error');
		}

		$cursos = $this->curso_model->obtener_todos();
		$data['cursos'] = $cursos;

		$this->load->view('cursos', $data);
	}

	public function nuevo()
	{
		// mensajes
		if ($this->session->flashdata('mensaje')) {
			$data['mensaje'] = $this->session->flashdata('mensaje');
		} elseif ($this->session->flashdata('error')) {
			$data['error'] = $this->session->flashdata('error');
		}

		$this->load->view('curso_nuevo');
	}

	public function editar($curso_id = 0)
	{
		// mensajes
		if ($this->session->flashdata('mensaje')) {
			$data['mensaje'] = $this->session->flashdata('mensaje');
		} elseif ($this->session->flashdata('error')) {
			$data['error'] = $this->session->flashdata('error');
		}

		if (empty($curso_id)) {
			redirect(base_url('/cursos'));
		}

		if ($this->curso_model->existe('id', $curso_id)) {

			$curso = $this->curso_model->obtener($curso_id);
			$data['curso'] = $curso;

			$this->load->view('curso_editar', $data);
		} else {
			redirect(base_url('/cursos'));
		}
	}

	public function guardar()
	{
		if (isset($_POST['guardar'])) {
			$guardar = $this->input->post('guardar');

			// validaciones comunes
			$this->form_validation->set_rules('nombre', 'Nombre', 'required');

			// validaciones particulares
			if ($guardar == 'EDICION') {
				$curso_id = $this->input->post('curso_id') ? $this->input->post('curso_id') : 0;

				// imagen opcional
				$imagen = $this->input->post('imagen') ? $this->input->post('imagen'): '';

				$this->form_validation->set_rules('curso_id', 'Curso', 'required');
			}

			$this->form_validation->set_message('required', 'Falta el campo %s');

			if ($this->form_validation->run() == FALSE) {
				// errores
				$this->session->set_flashdata('error', validation_errors());
				var_dump(validation_errors());
				if ($guardar == 'NUEVO') {
					$this->nuevo();
				} elseif ($guardar == 'EDICION') {
					$this->editar($curso_id);
				}
			} else {
				// datos a guardar
				$nombre = $this->input->post('nombre');

				// guardar nuevo curso
				if ($guardar == 'NUEVO') {
					$data = array('nombre' => $nombre);
					$curso_id = $this->curso_model->insertar($data);
					$this->session->set_flashdata('mensaje', 'Curso creado correctamente');

					redirect(base_url('/curso/editar/' . $curso_id));

				} elseif ($guardar == 'EDICION') {

					//========================================================
					// carga de imagen (opcional)
					// =======================================================
					$sw = TRUE;
					if (!empty($_FILES['imagen']['name'])) {
						$this->load->library('upload');
						$config['upload_path'] = './assets/img';
						$config['allowed_types'] = 'jpg|png|jpeg';
						$config['max_size'] = 256; // kilobytes
						$config['file_name'] = $_FILES['imagen']['name'];

						$this->upload->initialize($config);

						if (!$this->upload->do_upload('imagen'))
						{
							$sw = FALSE;

							$this->session->set_flashdata('error',$this->upload->display_errors());

							if($guardar == 'NUEVO'){
								$this->nuevo();
							}elseif($guardar == 'EDICION'){
								$this->editar($curso_id);
							}
						}
						else {
							$data = $this->upload->data();
							$imagen = $data['file_name'];
						}
					}

					// si la carga de la imagen fue satisfactoria
					// if($sw): La carga de la imagen fue satisfactoria
					if($sw) {
						// guardamos los datos
						$data = array('nombre' => $nombre, 'imagen'=>$imagen);
						$this->curso_model->actualizar($data, $curso_id);
						$this->session->set_flashdata('mensaje', 'Curso actualizado correctamente');

						redirect(base_url('/curso/editar/' . $curso_id));
					}
				}
			}

		} else {
			redirect(base_url('/cursos'));
		}
	}

	public function eliminar($curso_id = 0)
	{
		if (empty($curso_id)) {
			redirect(base_url('/cursos'));
		}

		if ($this->curso_model->existe('id', $curso_id)) {
			$this->curso_model->eliminar($curso_id);
			$this->session->set_flashdata('mensaje', 'Curso eliminado correctamente');
		} else {
			$this->session->set_flashdata('error', 'No existe el curso con el identificador '.$curso_id);
		}

		redirect(base_url('/cursos'));
	}
}
