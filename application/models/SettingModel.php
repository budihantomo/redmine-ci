<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Setting model file for Redmine-CI
 *
 * @package Redmine-CI
 * @author  WaveHack <email@wavehack.net>
 */
/**
 * Provides methods for reading global site settings.
 *
 * Settings are volatile and are stored in the database in table `settings`.
 * These are normally changed through the administrative section of Redmine-CI,
 * but can be adjusted through direct database access as emergency (which,
 * however, is not recommended).
 *
 * Settings are normally cached in APC on production servers to reduce the
 * number of database queries per request. One can manually clear the cache by
 * disabling caching in /application/config/redmine-ci.php or by invoking
 * methods {@link clear_cache()} or {@link reload_settings()}.
 *
 * @package Redmine-CI
 * @subpackage Models
 */
class SettingModel extends CI_Model
{
	/** @var array Settings array */
	private $_settings = array();

	/** @var bool Whether to use cache */
	private $_use_cache;

	/** @var int Cache TTL */
	private $_cache_ttl;

	/** @var bool Have we repopulated the cache this session? */
	private $_repopulated_cache = false;

	/**
	 * Constructor
	 *
	 * Checks config whether to use caching and calls {@link load_settings()} to
	 * populate the settings array.
	 */
	public function __construct()
	{
		parent::__construct();

		$this->_use_cache = $this->config->item('use_settings_cache');

		// Load driver cache if we have caching enabled
		if ($this->_use_cache)
		{
			$this->load->driver('cache', array(
					'adapter' => $this->config->item('settings_cache_adapter'),
					'backup' => $this->config->item('settings_cache_backup')
			));

			$this->_cache_ttl = $his->config->item('settings_cache_ttl');
		}

		$this->load_settings();
	}

	/**
	 * Returns a setting. Throws a notice if the setting doesn't exist.
	 *
	 * Settings returned are always strings, and should be treated and compared
	 * with as such.
	 *
	 * @todo Add option for unserialization?
	 * @param string $setting Setting name
	 * @return string|null
	 */
	public function get_setting($setting)
	{
		// If setting doesn't exist, throw a notice and return null
		if (!isset($this->_settings[$setting]))
		{
			trigger_error('Setting \'' . $setting . '\' not found', E_USER_NOTICE);
			return null;
		}

		return $this->_settings[$setting];
	}

	/**
	 * Clears the settings cache (if caching is enabled) and the settings array.
	 */
	public function clear_cache()
	{
		if ($this->_use_cache)
		{
			$this->cache->delete('settings');
		}

		$this->_settings = array();
	}

	/**
	 * Populates the settings array from the database and optionally caches them
	 * if caching is enabled.
	 */
	public function load_settings()
	{
		if (!$this->_use_cache || !($this->_settings = $this->cache->get('settings')))
		{
			// Get settings from database
			$this->db->select('setting,value');
			$query = $this->db->get('settings');

			foreach ($query->result() as $row)
			{
				$this->_settings[$row->setting] = $row->value;
			}

			// Check if we want to cache the results
			if ($this->_use_cache)
			{
				$this->cache->save('settings', $this->_settings, 3600);
				$this->_repopulated_cache = true;
			}
		}
	}

	/**
	 * Clears the settings cache and reloads all the settings.
	 *
	 * @see clear_cache()
	 * @see load_settings()
	 */
	public function reload_settings()
	{
		$this->clear_cache();
		$this->load_settings();
	}
}
