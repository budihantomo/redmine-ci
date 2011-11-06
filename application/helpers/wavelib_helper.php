<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// Handy custom functions I've gathered over the years ~WaveHack

if (!function_exists('isset_var'))
{
	function isset_var($var, $ret = false)
	{
		return (isset($var) ? $var : $ret);
	}
}

if (!function_exists('nempty_var'))
{
	function nempty_var($var, $ret = false)
	{
		return (!empty($var) ? $var : $ret);
	}
}

if (!function_exists('nnull_var'))
{
	function nnull_var($var, $ret = false)
	{
		return (($var !== null) ? $var : $ret);
	}
}

if (!function_exists('nfalse_var'))
{
	function nfalse_var($var, $ret = null)
	{
		return (($var !== false) ? $var : $ret);
	}
}

if (!function_exists('array_extend'))
{
	function array_extend($dst_array, $src_array)
	{
		if (!is_array($dst_array) || !is_array($src_array))
		{
			return;
		}

		foreach ($src_array as $k => $v)
		{
			if (is_array($v) && array_key_exists($k, $dst_array) && is_array($dst_array[$k]))
			{
				$dst_array[$k] = array_extend($dst_array[$k], $v);
			}
			else
			{
				$dst_array[$k] = $v;
			}
		}

		return $dst_array;
	}
}
