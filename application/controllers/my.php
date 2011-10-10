<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 */
/**
 */
class My extends CI_Controller
{
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
