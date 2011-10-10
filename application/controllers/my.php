<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 */
/**
 */
class My extends CI_Controller
{
	/**
	 */
	public function __construct()
	{
		parent::__construct();

		$this->load->model('AuthenticationModel');

		// Entire controller requires login
		$this->AuthenticationModel->require_login();
	}

	/**
	 */
	public function index()
	{
		return $this->page();
	}

	/**
	 */
	public function page()
	{
		echo 'my page';
	}
}
