<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| Assets Config
| -------------------------------------------------------------------------
*/

/**
 * Path to the script directory
 *
 * @var string
 **/
$config['script_dirs'] = array('public/js/');

/**
 * Path to the style directory
 *
 * @var string
 **/
$config['style_dirs'] = array('public/css/');

/**
 * Path to the (writeable) cache directory
 *
 * @var string
 **/
$config['cache_dir'] = 'public/cache/';

// --------------------------------------------------------------------

/**
 * should CSS files be combined
 *
 * @var bool
 **/
$config['combine_css'] = FALSE;

/**
 * should CSS files be minified
 *
 * @var bool
 **/
$config['minify_css'] = FALSE;

// --------------------------------------------------------------------

/**
 * should JS files be combined
 *
 * @var bool
 **/
$config['combine_js'] = FALSE;

/**
 * should JS files be minified
 *
 * @var bool
 **/
$config['minify_js'] = FALSE;

// --------------------------------------------------------------------

/**
 * should we check file modification dates when trying to load from cache
 *
 * this should be set to FALSE when in production, it will enable a 
 * store to be built for fast file lookups
 *
 * @var bool
 **/
$config['auto_update'] = TRUE;

// --------------------------------------------------------------------

/**
 * should the names of the cache files be static
 *
 * @var bool
 */
$config['static_cache'] = TRUE;

/* End of file assets.php */
/* Location: ./config/assets.php */
