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
		$this->load->model('Admin_Dashboard_model');
		$this->load->model('User_model');
		$this->load->database();
	}
	public function index()
	{
        $this->load->helper('url');
		$this->load->admin_template('admin_view/admin_dashboard', array('title' => 'Admin Dashboard'));
	}

	public function add_admin_view()
	{
		$this->load->admin_template('admin_view/add_admin_view', array('title' => 'Register An Admin'));
	}

	public function all_admin_view()
	{
		$res = $this->Admin_Dashboard_model->getAllAdmin();
		$this->load->admin_template('admin_view/all_admin_view', array('title' => 'View All Admin', 'data' => $res));
	}
	public function all_orphanages_view()
	{
		$res = $this->User_model->getAllOrphanage();
		$this->load->admin_template('admin_view/all_orphanages_view', array('title' => 'All Orphanages', 'data' => $res));
	}

	public function verify_orphanage()
	{
		$verified = $this->input->post('verified');
		$id = $this->input->post('id');
		
		$res = $this->Admin_Dashboard_model->verify_orphanage($id, $verified);

		echo json_encode($res);

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
   			$pin = $this->input->post('pin');
			$data = array(
				'username' => $this->input->post('username'),
				'password' => $encrypted_password
			);
			$res = $this->Admin_Dashboard_model->insert_admin($data, $pin);
			
			if($res == '')
			{
				$data1['status'] = 1;
				$data1['message'] = "Admin Added Successfully";
				// echo json_encode($data1);
				$this->session->set_flashdata('message',$data1);
				redirect('Admin_Dashboard/add_admin_view');
			}
			else
			{
				$data1['status'] = 0;
				$data1['message'] = $res;
				// echo json_encode($data1);
				$this->session->set_flashdata('message',$data1);
				redirect('Admin_Dashboard/add_admin_view');
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

	function delete_admin()
	{
		$data['id'] = $this->input->post('id');
		$data['pin'] = $this->input->post('pin');

		$res = $this->Admin_Dashboard_model->deleteOneAdmin($data);

		// echo json_encode(array('id'=>$id, 'pin'=>$pin));

		if($res == '')
		{
			$data1['status'] = 1;
			$data1['message'] = "Admin deleted Successfully";
			$this->session->set_flashdata('message',$data1);
			echo json_encode($data1);
			// redirect('Admin_Dashboard/add_admin_view');
		}
		else
		{
			$data1['status'] = 0;
			$data1['message'] = $res;
			$this->session->set_flashdata('message',$data1);
			echo json_encode($data1);
			// redirect('Admin_Dashboard/add_admin_view');
		}
	}





	public function admin_reg_super()
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

}
