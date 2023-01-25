<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

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
		if(!$this->session->userdata('id'))
		{
			redirect('index.php/Login');
		}
		$this->load->library('form_validation');
		$this->load->library('encrypt');
		$this->load->model('User_model');
		// $this->load->model('Admin_Dashboard_model');
		$this->load->database();
	}

    public function index()
	{
		$id = $this->session->userdata('id');
        $res = $this->User_model->getOneOrphanage($id);

		$this->load->helper('url');
		$this->load->template('orphanage_dashboard', array('title' => 'Your Orphanage', 'data' => $res));
	}

	public function open_for_adoption()
	{
		$open = $this->input->post('open');
		$id = $this->input->post('id');
		
		$res = $this->User_model->open_for_adoption($id, $open);

		echo json_encode($res);

	}

	public function update_data()
	{
		$column_name = $this->input->post('column_name');
		$field_to_be_updated = $this->input->post($column_name);
		$id = $this->input->post('id');
		
		$res = $this->User_model->update_data($id, $column_name, $field_to_be_updated);

		echo json_encode($res);

	}

	// public function getOneOrphanage($id)
	// {
	// 	$res = $this->User_model->getOneOrphanage($id);

	// 	$this->load->helper('url');
	// 	$this->load->template('orphanage_details', array('title' => 'Children Homes', 'data' => $res));
	// }

    function logout()
    {
        $data = $this->session->all_userdata();
        foreach($data as $row => $rows_value)
        {
            $this->session->unset_userdata($row);
        }
        redirect('Login');
    }


}
