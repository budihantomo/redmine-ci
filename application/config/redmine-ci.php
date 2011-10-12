<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// Add a few characters for password salt to increase security. Changing this
// during production invalidates ALL user passwords, forcing everyone to reset
// his or her password.
$config['auth_password_salt'] = '';

// Cache settings table?
$config['use_settings_caching'] = false;

// Which adapter to use for caching (apc/memcached/file, recommended apc)
$config['settings_cache_adapter'] = 'apc';

// Which backup adapter to use for caching, in case the previous one isn't
// available (apc/memcached/file, recommended file)
$config['settings_cache_backup'] = 'file';

// Default TTL for settings cache. Settings cache gets cleared and reloaded
// automatically when changing settings through the administrative section
// of the site.
$config['settings_cache_ttl'] = 3600;
