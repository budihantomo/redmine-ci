<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 */
/**
 */
class Users extends CI_Controller
{
	/**
	 */
	public function __construct()
	{
		parent::__construct();

		$this->load->helper('url');
	}

	/**
	 */
	public function _remap($method)
	{
		// No arguments, show user overview
		if ($this->uri->total_segments() === 1)
		{
			return $this->_overview();
		}

		// Single integer argument, user details
		if (($this->uri->total_segments() === 2) && (ctype_digit($this->uri->segment(2))))
		{
			return $this->_details($this->uri->segment(2));
		}

		// User id plus command and any other optional parameters
		if (($this->uri->total_segments() > 2) && (ctype_digit($this->uri->segment(2))))
		{
			switch ($this->uri->segment(3))
			{
				case 'edit':
					$section = (($this->uri->segment(4) !== false) ? $this->uri->segment(4) : 'general');
					return $this->_edit($this->uri->segment(2), $section);
					break;
			}
		}

		// No valid route, show 404
		show_404();
	}

	/**
	 */
	private function _overview()
	{
		echo 'user overview';
	}

	/**
	 */
	private function _details($user_id)
	{
		echo 'user details with id ', $user_id;
	}

	/**
	 */
	private function _edit($user_id, $section)
	{
		// Check for invalid edit section
		if (!in_array($section, array('general', 'groups', 'memberships')))
		{
			show_404();
		}

		echo 'edit user with id ', $user_id, ', section ', $section;
	}
}
