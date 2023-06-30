<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Prestamos extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->load->model("prestamos_model");
  }

  public function index()
  {
    if ($this->session->userdata('usuario') != null) {
      $datas['menu'] = 'prestamos';
      $datas['prestamos'] = $this->prestamos_model->getAll();
      $data['contenido'] = $this->load->view('prestamos/listar', $datas, TRUE);
      $this->load->view('cabezalypie', $data, FALSE);
    } else {
      redirect(base_url() . 'login');
    }
  }
}
