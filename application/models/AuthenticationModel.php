<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 */
/**
 */
class AuthenticationModel extends CI_Model
{
	/**
	 */
	public function __construct()
	{
		parent::__construct();

		$this->load->library('session');
		$this->load->helper('url');
	}

	/**
	 */
	public function login($data)
	{
		// Check if login and password vars exist
		if (!isset($data['login'], $data['password']))
		{
			return false;
		}

		// Hash our password with optional salt defined in /application/config/redmine-ci.php
		$this->config->load('redmine-ci');
		$hashed_password = sha1($this->config->item('auth_password_salt') . $data['password']);

		// Select from database
		$this->db->select('id,firstname,lastname');
		$this->db->where('login', $data['login']);
		$this->db->where('hashed_password', $hashed_password); // todo: add salt
		$this->db->where('status', 1);
		$query = $this->db->get('users');

		// Row doesn't exist
		if ($query->num_rows() === 0)
		{
			return false;
		}

		// Get data
		$userdata = $query->row();

		$sessiondata = array(
			'auth_id' => $userdata->id,
			'auth_firstname' => $userdata->firstname,
			'auth_lastname' => $userdata->lastname
		);

		// Set session
		$this->session->set_userdata($sessiondata);

		return true;
	}

	/**
	 */
	public function logout()
	{
		if (!$this->is_logged_in())
		{
			return;
		}

		// Destroy session
		$this->session->unset_userdata('auth_id');
		$this->session->unset_userdata('auth_firstname');
		$this->session->unset_userdata('auth_lastname');
	}

	/**
	 */
	public function register($data)
	{
	}

	/**
	 */
	public function is_logged_in()
	{
		return (
			($this->session->userdata('auth_id') !== false)
			&& ($this->session->userdata('auth_firstname') !== false)
			&& ($this->session->userdata('auth_lastname') !== false)
		);
	}

	/**
	 */
	public function require_login()
	{
		// Redirect to the login page if we're not logged in
		if (!$this->is_logged_in())
		{
			redirect('/login?back_url=' . urlencode(current_url()));
		}
	}

	/**
	 */
	public function require_no_login($url = '/my')
	{
		// Redirect back if we're already logged in
		if ($this->is_logged_in())
		{
			redirect($url);
		}
	}
}
