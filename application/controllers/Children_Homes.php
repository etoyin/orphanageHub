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
		$res = $this->User_model->getOneOrphanage($id);

		$this->load->helper('url');
		$this->load->template('orphanage_details', array('title' => 'Children Homes', 'data' => $res));
	}
}
