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
		$unVer = $this->User_model->getUnVerifiedOrphanage();
		$ver = $this->User_model->getVerifiedOrphanage();
        $this->load->helper('url');
		$this->load->admin_template('admin_view/admin_dashboard', array('title' => 'Admin Dashboard', 'ver'  => $ver, 'unVer' => $unVer));
	}

	public function add_admin_view()
	{
		$this->load->admin_template('admin_view/add_admin_view', array('title' => 'Register An Admin'));
	}

	public function add_post_category()
	{
		$this->load->admin_template('admin_view/add_category', array('title' => 'Add a Blog Post Category'));
	}

	public function add_post_view()
	{
		$categories = $this->Admin_Dashboard_model->getCat();
		$this->load->admin_template('admin_view/post_blog', array('title' => 'Post blog', 'categories' => $categories));
	}

	public function all_admin_view()
	{
		$res = $this->Admin_Dashboard_model->getAllAdmin();
		$this->load->admin_template('admin_view/all_admin_view', array('title' => 'View All Admin', 'data' => $res));
	}
	public function all_orphanages_view()
	{
		if($this->input->get('country'))
		{
			$res = $this->User_model->getAllOrphanageByCountry($this->input->get('country'));
		}
		else
		{
			$res = $this->User_model->getAllOrphanage();
		}
		$this->load->admin_template('admin_view/all_orphanages_view', array('title' => 'All Orphanages', 'data' => $res));
	}

	public function blog_images_upload()
	{
		$accepted_origins = array("http://localhost", "http://192.168.1.1", "https://theorphanagehub.org");

		/*********************************************
		 * Change this line to set the upload folder *
		 *********************************************/
		$imageFolder = "uploads/blog_images/";

		if (isset($_SERVER['HTTP_ORIGIN'])) {
			// same-origin requests won't set an origin. If the origin is set, it must be valid.
			if (in_array($_SERVER['HTTP_ORIGIN'], $accepted_origins)) {
			header('Access-Control-Allow-Origin: ' . $_SERVER['HTTP_ORIGIN']);
			} else {
			header("HTTP/1.1 403 Origin Denied");
			return;
			}
		}

		// Don't attempt to process the upload on an OPTIONS request
		if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
			header("Access-Control-Allow-Methods: POST, OPTIONS");
			return;
		}

		reset ($_FILES);
		$temp = current($_FILES);
		if (is_uploaded_file($temp['tmp_name'])){
			/*
			If your script needs to receive cookies, set images_upload_credentials : true in
			the configuration and enable the following two headers.
			*/
			// header('Access-Control-Allow-Credentials: true');
			// header('P3P: CP="There is no P3P policy."');

			// Sanitize input
			if (preg_match("/([^\w\s\d\-_~,;:\[\]\(\).])|([\.]{2,})/", $temp['name'])) {
				header("HTTP/1.1 400 Invalid file name.");
				return;
			}

			// Verify extension
			if (!in_array(strtolower(pathinfo($temp['name'], PATHINFO_EXTENSION)), array("gif", "jpg", "png", "jpeg"))) {
				header("HTTP/1.1 400 Invalid extension.");
				return;
			}

			// Accept upload if there was no origin, or if it is an accepted origin
			$filetowrite = $imageFolder . $temp['name'];
			move_uploaded_file($temp['tmp_name'], $filetowrite);

			// Determine the base URL
			$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on' ? "https://" : "http://";
			$baseurl = base_url($filetowrite);

			// Respond to the successful upload with JSON.
			// Use a location key to specify the path to the saved image resource.
			// { location : '/your/uploaded/image/file'}
			echo json_encode(array('location' => $baseurl));
			// var_dump($baseurl);
		} else {
			// Notify editor that the upload failed
			header("HTTP/1.1 500 Server Error");
		}
	}

	public function post_blog_to_db()
	{
		$this->form_validation->set_rules('category', 'Category Name', 'required|min_length[2]|max_length[50]');
		$this->form_validation->set_rules('title', 'Title', 'required|min_length[2]|max_length[50]');
		// $this->form_validation->set_rules('', 'Category Name', 'required|min_length[2]|max_length[50]');
		$this->form_validation->set_rules('post_content', 'Post', 'required|min_length[10]');

		if ($this->form_validation->run() == FALSE) {
			$data['response'] = 'failed';
			$data['message']  = validation_errors();
			echo json_encode($data);
		}
		else {
   			$pin = $this->input->post('pin');
			$data = array(
				'category' => $this->input->post('category'),
				'blog_post' => $this->input->post('post_content'),
				'title' => $this->input->post('title')
			);


			$config['upload_path'] = "./uploads/featured_images";
			$config['allowed_types'] = 'gif|jpeg|jpg|png';
			$this->load->library('upload', $config);
			if (!$this->upload->do_upload('featured_image'))
			{
				$error = array('error' => $this->upload->display_errors());
				echo json_encode($error);
				// $this->session->set_flashdata('message',$error);
				// redirect('Admin_Dashboard/add_post_view');

			}
			else
			{
				$uploadedData = array('upload_data' => $this->upload->data());
				$data['featured_image'] = $uploadedData["upload_data"]["file_name"];

				// echo json_encode($uploadedData);

				$res = $this->Admin_Dashboard_model->insert_blog_post($data, $pin);
				if($res == '')
				{
					$data1['status'] = 1;
					$data1['message'] = "Blog Posted Successfully";
					// echo json_encode($data1);
					$this->session->set_flashdata('message',$data1);
					redirect('Admin_Dashboard/add_post_view');
				}
				else
				{
					$data1['status'] = 0;
					$data1['message'] = $res;
					// echo json_encode($data1);
					$this->session->set_flashdata('message',$data1);
					redirect('Admin_Dashboard/add_post_view');
				}

			}
		}
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




	public function add_cat()
	{
		$this->form_validation->set_rules('cat_name', 'Category Name', 'required|min_length[2]|max_length[50]');

		if ($this->form_validation->run() == FALSE) {
			$data['response'] = 'failed';
			$data['message']  = validation_errors();
			echo json_encode($data);
		}
		else {
   			$pin = $this->input->post('pin');
			$data = array(
				'cat_name' => $this->input->post('cat_name')
			);
			$res = $this->Admin_Dashboard_model->insert_category($data, $pin);
			
			if($res == '')
			{
				$data1['status'] = 1;
				$data1['message'] = "Category Added Successfully";
				// echo json_encode($data1);
				$this->session->set_flashdata('message',$data1);
				redirect('Admin_Dashboard/add_post_category');
			}
			else
			{
				$data1['status'] = 0;
				$data1['message'] = $res;
				// echo json_encode($data1);
				$this->session->set_flashdata('message',$data1);
				redirect('Admin_Dashboard/add_post_category');
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


	function delete_blog()
	{
		$data['id'] = $this->input->get('id');
		$data['featured_image'] = $this->input->get('featured_image');
		$data['blog_images'] = json_decode($this->input->get('blog_images'));
		$data['pin'] = $this->input->post('pin');

		$res = $this->Admin_Dashboard_model->authorize($data['pin']);
		if($res)
		{
			foreach($data['blog_images'] as $key=>$row)
			{
				if (file_exists('uploads/blog_images/'.$row))
				{
					unlink('uploads/blog_images/'.$row);
				}
			}

			if (file_exists('uploads/featured_images/'.$data['featured_image']))
			{
				unlink('uploads/featured_images/'.$data['featured_image']);
			}

			$response = $this->Admin_Dashboard_model->delete_blog($data['id']);

			if ($response)
			{
				$message['status'] = 1;
				$message['message'] = "Deleted Successfully";	
				$this->session->set_flashdata('message',$message);
				redirect(base_url('Blog/index'));
			}
			//var_dump($data['blog_images']);
		}
		else{
			$message['status'] = 0;
			$message['message'] = "Not Authorized";
			$this->session->set_flashdata('message',$message);
			redirect(base_url('Blog/get_blog_detail?id='.$data['id']));
		}
		// var_dump($data['blog_images']);
		

		// echo json_encode($data);

		// if($res == '')
		// {
		// 	$data1['status'] = 1;
		// 	$data1['message'] = "Admin deleted Successfully";
		// 	$this->session->set_flashdata('message',$data1);
		// 	echo json_encode($data1);
		// 	// redirect('Admin_Dashboard/add_admin_view');
		// }
		// else
		// {
		// 	$data1['status'] = 0;
		// 	$data1['message'] = $res;
		// 	$this->session->set_flashdata('message',$data1);
		// 	echo json_encode($data1);
		// 	// redirect('Admin_Dashboard/add_admin_view');
		// }
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
