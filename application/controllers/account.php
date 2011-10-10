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
		// We can't login if we're already logged in
		$this->AuthenticationModel->require_no_login();

/*
		if ($this->AuthenticationModel->login(array('login' => 'Admin', 'password' => 'admin')))
		{
			if ($this->input->get('back_url') !== false)
			{
				redirect($this->input->get('back_url'));
			}
			else
			{
				redirect('/my');
			}
		}
*/

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
		// We can't register if we're logged in
		$this->AuthenticationModel->require_no_login();

		echo 'register';
	}

	/**
	 */
	public function lost_password()
	{
		// We can't use the lost password feature if we're logged in
		$this->AuthenticationModel->require_no_login();

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
