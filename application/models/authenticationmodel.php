<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Authentication model file for Redmine-CI
 *
 * @package Redmine-CI
 * @author  WaveHack <email@wavehack.net>
 */
/**
 * Provides methods for handling authentication.
 *
 * Methods {@link require_login()} and {@link require_no_login()} should
 * preferably be called in the controller's constructor to ensure authentication
 * requirements for all their methods.
 *
 * @package Redmine-CI
 * @subpackage Models
 */
class AuthenticationModel extends CI_Model
{
	/**
	 * Performs a login with the provided login and password details.
	 *
	 * @param array $data
	 * @return bool
	 */
	public function login($data)
	{
		// Check if login and password vars exist
		if (!isset($data['login'], $data['password']))
		{
			return false;
		}

		// Hash our password with optional salt defined in /application/config/redmine-ci.php
		$hashed_password = sha1($this->config->item('auth_password_salt') . $data['password']);

		// Select from database
		$this->db->select('id,firstname,lastname');
		$this->db->where('login', $data['login']);
		$this->db->where('hashed_password', $hashed_password);
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
	 * Logs the user out if the user is logged in
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
	 * todo
	 *
	 * @see UserModel::register()
	 * @param array $data
	 * @return bool
	 */
	public function register($data)
	{
		// todo
	}

	/**
	 * Returns whether the user is currently logged in
	 *
	 * @return bool
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
	 * Requires the user to be logged in, redirecting to /login if not
	 *
	 * @param bool $force Force login even if require_login settings is 0
	 * @param bool $use_back_url Use back URL to redirect to after logging in
	 */
	public function require_login($force = true, $use_back_url = true)
	{
		// Redirect to the login page if we're not logged in
		if (
			($force && !$this->is_logged_in())
			|| (!$this->is_logged_in() && $this->SettingModel->get_setting('login_required'))
		)
		{
			redirect('/login' . ($use_back_url ? ('?back_url=' . urlencode(current_url())) : ''));
		}
	}

	/**
	 * Requires the user not to be logged in on the current page. Does not
	 * automatically log out the user, but redirects back to $url.
	 *
	 * @param string $url URL to redirect to if the user is logged in
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
