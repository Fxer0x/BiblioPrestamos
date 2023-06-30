<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Libros extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->load->model("libros_model");
  }

  public function index()
  {
    if ($this->session->userdata('usuario') != null) {
      $datas['menu'] = 'libros';
      $datas['libros'] = $this->libros_model->getAll();
      $datas['prestamos'] = $this->libros_model->getPrestamos();
      $data['contenido'] = $this->load->view('libros/listar', $datas, TRUE);
      $this->load->view('cabezalypie', $data, FALSE);
    } else {
      redirect(base_url() . 'login');
    }
  }

  public function eliminar()
  {
    if ($this->session->userdata('usuario') != null && $this->session->userdata('usuario')->Rol == 'Admin') {
      $id = $this->input->post('id');
      $respuesta = $this->libros_model->eliminar($id);
      if ($respuesta != false) {
        $status = 200;
        $message = '¡Libro eliminado exitosamente!';
        $response = array(
          'status' => $status,
          'message' => $message
        );
      } else {
        $status = 401;
        $message = '¡Error al eliminar el libro!';
        $response = array(
          'status' => $status,
          'message' => $message
        );
      }
    } else {
      $status = 403;
      $message = '¡No tiene permisos para realizar esta acción!';
      $response = array(
        'status' => $status,
        'message' => $message
      );
    }
    header('Content-Type: application/json');
    echo json_encode($response);
  }

  public function agregar()
  {
    if ($this->session->userdata('usuario') != null && $this->session->userdata('usuario')->Rol == 'Admin') {
      $datas['menu'] = 'libros';
      $data['contenido'] = $this->load->view('libros/agregar', $datas, TRUE);
      $this->load->view('cabezalypie', $data, FALSE);
    } else {
      redirect(base_url() . 'login');
    }
  }

  public function ingresar()
  {
    if ($this->session->userdata('usuario') != null && $this->session->userdata('usuario')->Rol == 'Admin') {
      $titulo = $this->input->post('titulo');
      $autor = $this->input->post('autor');
      $anio = $this->input->post('anio');
      //verificar que anio sea numero
      if (!is_numeric($anio) || $anio < 0) {
        $status = 401;
        $message = '¡El año debe ser un número positivo!';
        $response = array(
          'status' => $status,
          'message' => $message
        );
        header('Content-Type: application/json');
        echo json_encode($response);
        return;
      }
      $respuesta = $this->libros_model->ingresar($titulo, $autor, $anio);
      if ($respuesta != false) {
        $status = 200;
        $message = '¡Libro agregado exitosamente!';
        $response = array(
          'status' => $status,
          'message' => $message
        );
      } else {
        $status = 401;
        $message = '¡Error al agregar el libro!';
        $response = array(
          'status' => $status,
          'message' => $message
        );
      }
    } else {
      $status = 403;
      $message = '¡No tiene permisos para realizar esta acción!';
      $response = array(
        'status' => $status,
        'message' => $message
      );
    }
    header('Content-Type: application/json');
    echo json_encode($response);
  }

  public function editar($id)
  {
    if ($this->session->userdata('usuario') != null && $this->session->userdata('usuario')->Rol == 'Admin') {
      $datas['menu'] = 'libros';
      $datas['libro'] = $this->libros_model->getLibro($id);
      if ($datas['libro'] == false) {
        redirect(base_url() . 'libros');
      }
      $data['contenido'] = $this->load->view('libros/editar', $datas, TRUE);
      $this->load->view('cabezalypie', $data, FALSE);
    } else {
      redirect(base_url() . 'login');
    }
  }

  public function cambiar()
  {
    if ($this->session->userdata('usuario') != null && $this->session->userdata('usuario')->Rol == 'Admin') {
      $id = $this->input->post('id');
      $titulo = $this->input->post('titulo');
      $autor = $this->input->post('autor');
      $anio = $this->input->post('anio');
      //verificar que anio sea numero
      if (!is_numeric($anio) || $anio < 0) {
        $status = 401;
        $message = '¡El año debe ser un número positivo!';
        $response = array(
          'status' => $status,
          'message' => $message
        );
        header('Content-Type: application/json');
        echo json_encode($response);
        return;
      }
      $respuesta = $this->libros_model->cambiar($id, $titulo, $autor, $anio);
      if ($respuesta != false) {
        $status = 200;
        $message = '¡Libro editado exitosamente!';
        $response = array(
          'status' => $status,
          'message' => $message
        );
      } else {
        $status = 401;
        $message = '¡Error al editar el libro!';
        $response = array(
          'status' => $status,
          'message' => $message
        );
      }
    } else {
      $status = 403;
      $message = '¡No tiene permisos para realizar esta acción!';
      $response = array(
        'status' => $status,
        'message' => $message
      );
    }
    header('Content-Type: application/json');
    echo json_encode($response);
  }

  public function solicitar()
  {
    if ($this->session->userdata('usuario') != null && $this->session->userdata('usuario')->Rol == 'Usuario') {
      $id = $this->input->post('id');
      $respuesta = $this->libros_model->solicitar($id);
      if ($respuesta != false) {
        if ($respuesta === 'solicitado') {
          $status = 401;
          $message = 'Libro no disponible';
          $response = array(
            'status' => $status,
            'message' => $message
          );
        } else {
          $status = 200;
          $message = 'Libro solicitado exitosamente';
          $response = array(
            'status' => $status,
            'message' => $message
          );
        }
      } else {
        $status = 401;
        $message = '¡Error al enviar la solicitud!';
        $response = array(
          'status' => $status,
          'message' => $message
        );
      }
    } else {
      $status = 403;
      $message = '¡No tiene permisos para realizar esta acción!';
      $response = array(
        'status' => $status,
        'message' => $message
      );
    }
    header('Content-Type: application/json');
    echo json_encode($response);
  }
}
