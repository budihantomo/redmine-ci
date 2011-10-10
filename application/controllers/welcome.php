<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 */
/**
 */
class Welcome extends CI_Controller
{
	/**
	 */
	public function __construct()
	{
		parent::__construct();

		$this->load->model('AuthenticationModel');
		$this->load->helper('url');
	}

	/**
	 */
	public function index()
	{
		// If we're not logged in, redirect to the login page
		$this->AuthenticationModel->require_login();

		// We're logged in (since above line didn't redirect to login). Original
		// Redmine calls /my internally here, but we can't do that because we
		// can't call another controller's function, so we'll just redirect.
		redirect('/my');
	}
}
