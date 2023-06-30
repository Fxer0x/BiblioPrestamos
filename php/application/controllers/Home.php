<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->load->model("home_model");
  }

  public function index()
  {
    if ($this->session->userdata('usuario') != null) {
      $datas['menu'] = 'home';
      $data['contenido'] = $this->load->view('home', $datas, TRUE);
      $this->load->view('cabezalypie', $data, FALSE);
    } else {
      redirect(base_url() . 'login');
    }
  }

  public function login()
  {
    $this->load->view('login', NULL, FALSE);
  }

  public function ingresar()
  {
    $email = $this->input->post('email');
    $pass = $this->input->post('pass');
    if ($email == '' || $pass == '') {
      $status = 401;
      $message = '¡Usuario o contraseña incorrectos!';
      $response = array(
        'status' => $status,
        'message' => $message
      );
      header('Content-Type: application/json');
      echo json_encode($response);
      return;
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $status = 401;
      $message = '¡Usuario o contraseña incorrectos!';
      $response = array(
        'status' => $status,
        'message' => $message
      );
      header('Content-Type: application/json');
      echo json_encode($response);
      return;
    }
    $usuario = $this->home_model->ingresar($email, $pass);
    if ($usuario != false) {
      $this->session->set_userdata('usuario', $usuario);
      $status = 200;
      $message = '¡Inicio de sesión exitoso!';
      $response = array(
        'status' => $status,
        'message' => $message
      );
    } else {
      $status = 401;
      $message = '¡Usuario o contraseña incorrectos!';
      $response = array(
        'status' => $status,
        'message' => $message
      );
    }
    header('Content-Type: application/json');
    echo json_encode($response);
  }

  public function salir()
  {
    $this->session->sess_destroy();
    $status = 200;
    $message = '¡Sesión cerrada!';
    $response = array(
      'status' => $status,
      'message' => $message
    );
    header('Content-Type: application/json');
    echo json_encode($response);
  }

  public function registro()
  {
    $this->load->view('registro', NULL, FALSE);
  }

  public function crear()
  {
    $nombre = $this->input->post('nombre');
    $apellido = $this->input->post('apellido');
    $direccion = $this->input->post('direccion');
    $telefono = $this->input->post('telefono');
    $email = $this->input->post('email');
    $pass = $this->input->post('pass');
    $passConf = $this->input->post('passConf');
    if ($nombre == '' || $apellido == '' || $direccion == '' || $telefono == '' || $email == '' || $pass == '' || $passConf == '') {
      $status = 401;
      $message = '¡Todos los campos son obligatorios!';
      $response = array(
        'status' => $status,
        'message' => $message
      );
      header('Content-Type: application/json');
      echo json_encode($response);
      return;
    }
    if ($pass != $passConf) {
      $status = 401;
      $message = '¡Las contraseñas no coinciden!';
      $response = array(
        'status' => $status,
        'message' => $message
      );
      header('Content-Type: application/json');
      echo json_encode($response);
      return;
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $status = 401;
      $message = '¡El correo no es válido!';
      $response = array(
        'status' => $status,
        'message' => $message
      );
      header('Content-Type: application/json');
      echo json_encode($response);
      return;
    }
    $respuesta = $this->home_model->crear($nombre, $apellido, $direccion, $telefono, $email, $pass);
    if ($respuesta != false) {
      if ($respuesta == 'creado') {
        $status = 200;
        $message = '¡Registro exitoso!';
        $response = array(
          'status' => $status,
          'message' => $message
        );
        $usuario = $this->home_model->ingresar($email, $pass);
        $this->session->set_userdata('usuario', $usuario);
      } else {
        $status = 401;
        $message = '¡El correo ya existe!';
        $response = array(
          'status' => $status,
          'message' => $message
        );
      }
    } else {
      $status = 401;
      $message = '¡Error al registrar!';
      $response = array(
        'status' => $status,
        'message' => $message
      );
    }
    header('Content-Type: application/json');
    echo json_encode($response);
  }
}
