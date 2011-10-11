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

		$this->load->model('AuthenticationModel');
	}

	/**
	 */
	public function login()
	{
		// We can't login if we're already logged in
		$this->AuthenticationModel->require_no_login();

		$data = array();

		// Check if user submitted the login form
		if (
			// Form submit
			($this->input->post('login') !== false)
			// And valid credentials
			&& ($this->AuthenticationModel->login(array(
				'login' => $this->input->post('username'),
				'password' => $this->input->post('password')
			)) !== false)
		)
		{
			// Loggin succesful, redirect to /my
			redirect('/my');
		}
		else
		{
			// No login, show login form
			$this->load->view('_page', array(
				'head_title' => 'Redmine-CI',
				'head_canonical' => base_url('login'),
				'content' => $this->load->view('account/login', $data, TRUE)
			));
		}
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
