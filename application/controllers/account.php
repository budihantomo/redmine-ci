<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 */
/**
 */
class Account extends CI_Controller
{
	/**
	 */
	public function __construct()
	{
		parent::__construct();

		$this->load->helper('url');
		$this->load->model('AuthenticationModel');
	}

	/**
	 */
	public function login()
	{
		// If we're already logged in, redirect to /my
		if ($this->AuthenticationModel->is_logged_in())
		{
			redirect('/my');
		}

//		if ($this->AuthenticationModel->login(array('login' => 'Admin', 'password' => 'admin')))
//		{
//			redirect('/my');
//		}

		echo 'login';
	}

	/**
	 */
	public function logout()
	{
		$this->AuthenticationModel->logout();
		redirect('/login');
	}

	/**
	 */
	public function register()
	{
		// If we're logged in, redirect to /my
		if ($this->AuthenticationModel->is_logged_in())
		{
			redirect('/my');
		}

		echo 'register';
	}

	/**
	 */
	public function lost_password()
	{
		echo 'lost password';
	}

	/**
	 */
	public function overview()
	{
		echo 'account overview';
	}

	/**
	 */
	public function change_password()
	{
		echo 'change password';
	}

	/**
	 */
	public function reset_rss_key()
	{
		echo 'reset rss key';
	}
}
