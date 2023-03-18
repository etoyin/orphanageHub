<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Children_Homes extends CI_Controller {

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
		$this->load->model('User_model');
		$this->load->library('form_validation');
		$this->load->database();
	}

	public function index()
	{
		if(!$this->input->get('country'))
		{
			$res = $this->User_model->getVerifiedOrphanage();
		}
		else {
			$res = $this->User_model->getVerifiedOrphanageByCountry($this->input->get('country'));
		}
        $this->load->helper('url');
		$this->load->template('children_homes', array('title' => 'Children Homes', 'data' => $res));
	}

	public function getOneOrphanage($id)
	{
		if($this->session->userdata('id'))
		{
			$user = $this->User_model->getOneOrphanage($this->session->userdata('id'));
		}
		else{
			$user = "";
		}
		$res = $this->User_model->getOneOrphanage($id);
		$get_comments = $this->User_model->getCommentsbyId($id);

		$this->load->helper('url');
		$this->load->template('orphanage_details', array(
								'comments' => $get_comments, 
								'title' => 'Children Homes', 
								'data' => $res, 
								'user' => $user));
	}

	public function getOneComment($id)
	{
		$res = $this->User_model->getOneComment($id);

		echo json_encode($res);

	}
	public function post_comment()
	{
		$this->form_validation->set_rules('id', 'orphanageId', 'required|min_length[1]'); // Validation for Name Field
		$this->form_validation->set_rules('comment', 'Comment', 'required|min_length[1]'); // Validation for E-mail field.
		// $this->form_validation->set_rules('image', 'Upload Picture', 'required|min_length[6]'); // Validation for Address Field.

		if ($this->form_validation->run() == FALSE) {
			$data['response'] = 'failed';
			$data['status'] = 0;
			$data['message']  = validation_errors();
			echo json_encode($data);
		}
		else 
		{
			$data['orphanage_id'] = $this->input->post("id");
			$data['comment'] = $this->input->post("comment");
			$data['name_comment'] = $this->input->post("name_comment");
			$data['created_at'] = $date = date('Y-m-d H:i:s');

			$data['name_comment'] = (strlen($data['name_comment']) > 1) ? $data['name_comment'] : "Anonymous";

			if($this->User_model->comments_insert($data))
			{
				$data1['response'] = 'Your Comments was sent successfully';
				$data1['status'] = 1;

				echo json_encode($data1);
			}
			else {
				$data1['response'] = 'Your Comments was not sent. It failed!!!';
				$data1['status'] = 0;

				echo json_encode($data1);
			}

		}

	}

	public function post_reply()
	{
		$this->form_validation->set_rules('id', 'Comment Id', 'required|min_length[1]'); // Validation for Name Field
		$this->form_validation->set_rules('reply_content', 'Reply', 'required|min_length[1]'); // Validation for E-mail field.
		// $this->form_validation->set_rules('image', 'Upload Picture', 'required|min_length[6]'); // Validation for Address Field.

		if ($this->form_validation->run() == FALSE) {
			$data['response'] = 'failed';
			$data['status'] = 0;
			$data['message']  = validation_errors();
			echo json_encode($data);
		}
		else 
		{
			$data['comment_id'] = $this->input->post("id");
			$data['content'] = $this->input->post("reply_content");
			$data['name_reply'] = $this->input->post("name_reply");
			$data['created_at'] = $date = date('Y-m-d H:i:s');

			$data['name_reply'] = (strlen($data['name_reply']) > 1) ? $data['name_reply'] : "Anonymous";

			if($this->User_model->reply_insert($data))
			{
				$data1['response'] = 'Your reply was sent successfully';
				$data1['status'] = 1;

				echo json_encode($data1);
			}
			else {
				$data1['response'] = 'Your reply was not sent. It failed!!!';
				$data1['status'] = 0;

				echo json_encode($data1);
			}

		}

	}
}
