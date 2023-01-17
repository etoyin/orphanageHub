<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_Dashboard extends CI_Controller {

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
		if(!$this->session->userdata('adminId'))
		{
			redirect('Admin');
		}
		$this->load->library('form_validation');
		$this->load->library('encrypt');
		$this->load->model('Admin_model');
		$this->load->database();
	}
	public function index()
	{
        $this->load->helper('url');
		$this->load->admin_template('admin_view/admin_dashboard', array('title' => 'Admin Dashboard'));
	}

	

	public function admin_reg()
	{
		$this->form_validation->set_rules('username', 'Username', 'required|min_length[2]|max_length[50]');
		$this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
		$this->form_validation->set_rules('pin', 'Pin', 'required|min_length[4]|max_length[4]');

		if ($this->form_validation->run() == FALSE) {
			$data['response'] = 'failed';
			$data['message']  = validation_errors();
			echo json_encode($data);
		}
		else {
			$encrypted_password = $this->encrypt->encode($this->input->post('password'));
   			$encrypted_pin = $this->encrypt->encode($this->input->post('pin'));
			$data = array(
				'username' => $this->input->post('username'),
				'password' => $encrypted_password,
				'pin' => $encrypted_pin
			);
			$res = $this->Admin_model->form_insert($data);
			
			if ($res == true)
			{
				$response['status'] = 1;
				$response['message'] = 'Form Submitted Successfully';
				echo json_encode($response);
			}
			else{
				$response['status'] = 0;
				$response['message'] = 'Error in form Submission!';
				echo json_encode($response);
			}	
		}
	}

	function logout()
    {
        $data = $this->session->all_userdata();
        foreach($data as $row => $rows_value)
        {
            $this->session->unset_userdata($row);
        }
        redirect('Admin');
    }

}
