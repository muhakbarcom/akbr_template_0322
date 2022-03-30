<?php
// controller dashboard codeigniter 3
class Auth extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->library('form_validation');
    $this->load->model('User_model');
    $this->load->config('akbrconfig');
  }

  public function index()
  {

    // rules login
    $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
    $this->form_validation->set_rules('password', 'Password', 'required|trim');


    if ($this->form_validation->run() == FALSE) {
      $titleWeb = $this->config->item('title');
      $titlePage = 'Login - ' . $titleWeb;
      $data = array(
        'titlePage' => $titlePage,
        'titleWeb' => $titleWeb
      );
      $this->load->view('auth/login', $data);
    } else {
      $this->_login();
    }
  }

  private function _login()
  {
    $email = $this->input->post('email');
    $password = $this->input->post('password');

    $user = $this->db->get_where('user', ['email' => $email])->row_array();

    if ($user) {
      if ($user['is_active'] == 1) {
        if (password_verify($password, $user['password'])) {

          // role_id to role_name
          $role_id = $user['role_id'];
          $role = $this->db->get_where('user_role', ['id' => $role_id])->row_array();
          $role_name = $role['role_name'];

          $data = [
            'email' => $user['email'],
            'role_id' => $user['role_id'],
            'role_name' => $role_name,
            'id' => $user['id'],
            'name' => $user['name'],
            'image' => $user['image'],
            'is_active' => $user['is_active'],
            'date_created' => $user['date_created']
          ];
          $this->session->set_userdata($data);
          redirect('dashboard');
        } else {
          $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
          Wrong password!
          </div>');
          redirect('auth');
        }
      } else {
        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
        This email has not been activated!
        </div>');
        redirect('auth');
      }
    } else {
      $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
      Email is not registered!
      </div>');
      redirect('auth');
    }
  }

  // register
  public function register()
  {
    // rules
    $this->form_validation->set_rules('name', 'Name', 'required|trim');
    $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]', [
      'is_unique' => 'This email is already registered!'
    ]);
    $this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[3]|matches[confirm_password]', [
      'matches' => 'Passwords are not the same!',
      'min_length' => 'Password is too short!'
    ]);
    $this->form_validation->set_rules('confirm_password', 'Password', 'required|trim|matches[password]');

    if ($this->form_validation->run() == false) {
      $titleWeb = $this->config->item('title');
      $titlePage = 'Registration - ' . $titleWeb;
      $data = array(
        'titlePage' => $titlePage,
        'titleWeb' => $titleWeb
      );
      // $this->wmm->auth_login();
      $this->load->view('auth/register', $data);
    } else {
      $data = [
        'name' => htmlspecialchars($this->input->post('name', true), ENT_QUOTES),
        'email' => htmlspecialchars($this->input->post('email', true), ENT_QUOTES),
        'image' => 'default.jpg',
        'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
        'role_id' => 2,
        'is_active' => 1,
        'date_created' => time()
      ];

      // insert to user_model
      $this->User_model->insert($data);
      $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Congratulation! your account has been created.</div>');

      redirect('auth');
    }
  }


  public function logout()
  {

    $this->session->unset_userdata('email');
    $this->session->unset_userdata('role_id');

    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">You have been logged out!</div>');

    redirect('auth');
  }
}
