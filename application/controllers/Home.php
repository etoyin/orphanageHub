<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

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

		$this->load->model('Admin_Dashboard_model');
		$this->load->library('form_validation');
		$this->load->model('User_model');
		$this->load->database();
	}

	public function index()
	{
		$resBlog = $this->Admin_Dashboard_model->getAllBlog();
        $this->load->helper('url');
		$this->load->template('home_page', array('title' => 'Home', 'blog' => $resBlog));
	}

	public function submit_email()
	{
		$this->form_validation->set_rules('name', 'Name', 'required');		
		$this->form_validation->set_rules('subject', 'Subject', 'required');
		$this->form_validation->set_rules('content', 'Content', 'required');

		if ($this->form_validation->run() == FALSE) {
			$data['response'] = 'failed';
			$data['message']  = validation_errors();
			echo json_encode($data);
		}
		else{
			$data['name'] = $this->input->post('name');
			$data['subject'] = $this->input->post('subject');
			$data['content'] = $this->input->post('content');

			$message = '<p> You have a message from '.$this->input->post('name').'</p> <div>'.$data['content'].'</div>';
			// echo json_encode($data);

			$config = array(
				'protocol'  => 'mail',
				'smtp_host' => 'mail.theorphanagehub.org',
				'smtp_port' => 465,
				'smtp_user' => 'info@theorphanagehub.org', 
				'smtp_pass' => 'Cj0Wv8tliVze', 
				'mailtype'  => 'html',
				'charset'   => 'iso-8859-1',
				'wordwrap'  => TRUE
			);

			$this->load->library('email', $config);
			$this->email->set_newline("\r\n");
			$this->email->from('info@theorphanagehub.org');
			$this->email->to('info@theorphanagehub.org');
			$this->email->subject($data['subject'].' from '.$data['name']);
			$this->email->message($message);

			if($this->email->send())
			{
				$data1['status'] = 1;
				$data1['message'] = 'Message sent successfully';
				echo json_encode($data1);

			}else{
				$data1['status'] = 0;
				$data1['message'] = 'A Problem was encountered. Try again!!';
				echo json_encode($data1);
			}
		}
		// $resBlog = $this->Admin_Dashboard_model->getAllBlog();
        // $this->load->helper('url');
		// $this->load->template('home_page', array('title' => 'Home', 'blog' => $resBlog));
	}
}
