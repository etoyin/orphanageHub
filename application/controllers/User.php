<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

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
			redirect('index.php/Dashboard');
		}
		$this->load->library('form_validation');
		$this->load->library('encrypt');
		$this->load->model('User_model');
		$this->load->database();
	}
	public function index()
	{
        $this->load->helper('url');
		$this->load->template('register', array('title' => 'Register'));
	}
    public function register()
	{
        $this->load->helper('url');
		$this->load->template('register', array('title' => 'Register'));
	}

	public function regSubmit()
	{
		$this->form_validation->set_rules('orphanage', 'OrphanageName', 'required|min_length[2]|max_length[50]'); // Validation for Name Field
		$this->form_validation->set_rules('owner', 'Owner', 'required|min_length[2]|max_length[50]'); // Validation for Name Field
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email'); // Validation for E-mail field.
		$this->form_validation->set_rules('phone', 'Contact No.', 'required|regex_match[/^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,7}$/]'); // Validation for Contact Field.
		$this->form_validation->set_rules('address', 'Address', 'required|min_length[10]|max_length[100]'); // Validation for Address Field.
		$this->form_validation->set_rules('password', 'Password', 'required|min_length[6]'); // Validation for Address Field.

		if ($this->form_validation->run() == FALSE) {
			$data['response'] = 'failed';
			$data['message']  = validation_errors();
			echo json_encode($data);
		}
		else {
			$verification_key = md5(rand());
   			$encrypted_password = $this->encrypt->encode($this->input->post('password'));
			$data = array(
				'name' => $this->input->post('orphanage'),
				'email' => $this->input->post('email'),
				'phone_number' => $this->input->post('phone'),
				'address' => $this->input->post('address'),
				'password' => $encrypted_password,
				'owner' => $this->input->post('owner'),
				'verification_key' => $verification_key
			);

			if ($this->User_model->email_exists($data['email']))
			{
				$response['status'] = 0;
				$response['message'] = 'Error! Email already used';
				echo json_encode($response);
			}
			else{
				$res = $this->User_model->form_insert($data);
				
				if ($res == true)
				{
					// $subject = "Please verify email for login";
					// $message = "
					// 	<p>Hi ".$this->input->post('orphanage')."</p>
					// 	<p>This is email verification mail from Codeigniter Login Register system. For complete registration process and login into system. First you want to verify you email by click this <a href='".base_url()."user/verify_email/".$verification_key."'>link</a>.</p>
					// 	<p>Once you click this link your email will be verified and you can login into system.</p>
					// 	<p>Thanks,</p>";

					// $config = array(
					// 	'protocol'  => 'smtp',
					// 	'smtp_host' => 'smtpout.secureserver.net',
					// 	'smtp_port' => 80,
					// 	'smtp_user' => 'toyinadesina60@gmail.com', 
					// 	'smtp_pass' => 'Jesus091?', 
					// 	'mailtype'  => 'html',
					// 	'charset'   => 'iso-8859-1',
					// 	'wordwrap'  => TRUE
					// );

					// $this->load->library('email', $config);
					// $this->email->set_newline("\r\n");
					// $this->email->from('toyinadesina60@gmail.com');
					// $this->email->to($this->input->post('email'));
					// $this->email->subject($subject);
					// $this->email->message($message);
					
					// if($this->email->send())
					// {
					// 	$this->session->set_flashdata('message', 'Check in your email for email verification mail');
					// 	redirect('user');
					// }
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

	public function verify_email()
	{

	}
}
