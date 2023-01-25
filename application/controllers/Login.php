<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/userguide3/general/urls.html
	 */

	function __construct() {
		parent::__construct();
		if($this->session->userdata('id'))
		{
			redirect('Dashboard');
		}
		$this->load->library('form_validation');
		$this->load->library('encrypt');
		$this->load->model('User_model');
		$this->load->database();
	}
	public function index()
	{
        $this->load->helper('url');
		$this->load->template('login_view', array('title' => 'Login'));
	}

	
	public function login()
	{
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email');		
		$this->form_validation->set_rules('password', 'Password', 'required');

		if ($this->form_validation->run() == FALSE) {
			$data['response'] = 'failed';
			$data['message']  = validation_errors();
			echo json_encode($data);
		}
		else{
			$data = array(
				'email' => $this->input->post('email'),
				'password' => $this->input->post('password'),
			);

			$result = $this->User_model->can_login($data);

			if($result == '')
			{
				// $data1['status'] = 1;
				// $data1['message'] = "Welcome!!";

				// echo json_encode($data1);
				redirect('Dashboard/index');
			}
			else
			{
				$data1['status'] = 0;
				$data1['message'] = $result;
                // echo json_encode($data1);
				$this->session->set_flashdata('message',$result);
				redirect('Login');
			}
		}
	}

	public function verify_email()
	{

	}
}
