<?php
// controller dashboard codeigniter 3
class Dashboard extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->config('akbrconfig');

    // $this->wmm->auth();
    // $this->load->
    // $this->load->model('m_dashboard');
  }
  public function index()
  {
    $data['titlePage'] = 'Dashboard';
    $data['titleWeb'] = $this->config->item('title');
    $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

    $this->load->view('dashboard/header', $data);
    $this->load->view('dashboard/index');
    $this->load->view('dashboard/footer');
  }
}
