<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Blog extends CI_Controller {

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
		$this->load->model('User_model');
		$this->load->database();
	}
	public function index()
	{
        $res = $this->Admin_Dashboard_model->getCat();
        $resBlog = $this->Admin_Dashboard_model->getAllBlog();
        $this->load->helper('url');
		$this->load->template('blog_view', array('title' => 'OrphanageHub Blog', 'cat' => $res, 'blog' => $resBlog));
	}
    public function get_blog()
    {
        $cat_name = $this->input->get('cat');
        $resBlog = $this->Admin_Dashboard_model->getByCat($cat_name);
		$this->load->template('blog_view_cat', array('title' => 'OrphanageHub Blog', 'blog' => $resBlog));

    }
    public function get_blog_detail()
    {
        $id = $this->input->get('id');
        $resBlog = $this->Admin_Dashboard_model->getById($id);
		$this->load->template('blog_view_detail', array('title' => 'OrphanageHub Blog', 'blog' => $resBlog));

    }
}
