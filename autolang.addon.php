<?php

/**
 * @file autolang.addon.php
 * @author Kijin Sung <kijin@kijinsung.com>
 * @license LGPL v2.1 <http://www.gnu.org/licenses/lgpl-2.1.html>
 * @brief Language Auto-Select addon
 */
if(!defined('__XE__')) exit();
if($called_position !== 'before_module_init') return;
if(isset($_COOKIE['lang_type']) || isset($_SESSION['lang_type'])) return;

// Detect the browser's language
$browser_accept_langs = $_SERVER['HTTP_ACCEPT_LANGUAGE'];
if(!$browser_accept_langs) return;

// Get the list of languages supported in this website
$supported_langs = Context::get('lang_supported');
if(!is_array($supported_langs)) $supported_langs = array($supported_langs);

// Check if each language matches the browser's language
foreach($supported_langs as $key => $value)
{
	if(!strncasecmp($key, $browser_accept_langs, strlen($key)))
	{
		// Set cookie and session variables to prevent checking again
		setcookie('lang_type', $key, time() + (86400 * 365));
		$_COOKIE['lang_type'] = $key;
		$_SESSION['lang_type'] = $key;
		
		// Set the detected language in Context class
		$context = Context::getInstance();
		$previous_lang = $context->getLangType();
		
		// If the language is different from the previous setting
		if ($previous_lang !== $key)
		{
			// Reset the global language variable and loaded lang files list
			$GLOBALS['lang'] = new stdClass();
			$context->loaded_lang_files = array();
			$context->setLangType($key);
			
			// Reload all lang files for currently loaded modules
			$context->loadLang(_XE_PATH_ . 'common/lang/');
			$loaded_modules = array_keys($GLOBALS['_loaded_module']);
			foreach($loaded_modules as $module_name)
			{
				$context->loadLang(_XE_PATH_ . 'modules/' . $module_name . '/lang');
			}
		}
		return;
	}
}
