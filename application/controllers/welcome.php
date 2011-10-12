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
	}

	/**
	 */
	public function index()
	{
		// If login is required and we're not logged in, redirect to login page
		$this->AuthenticationModel->require_login(false, false);

		if ($this->AuthenticationModel->is_logged_in())
		{
			// If we're logged in, redirect to /my. Redmine calls /my internally
			// here, but we can't do that since we can't call another
			// controller's method.
			redirect('/my');
		}
		else
		{
			// We're not logged in and we don't need to, because setting
			// login_required equals 0, so redirect to project overview.
			// Todo: add setting for default landing page
			redirect('/projects');
		}
	}
}
