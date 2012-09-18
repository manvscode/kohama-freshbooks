<?php defined('SYSPATH') or die('No direct script access.');


if( !defined( 'MODULE_FRESHBOOKS' ) )
{
	function freshbooks_auto_load($class) 
	{ 
		// Transform the class name into a path 
		$file = str_replace( '_', '/', $class ); 

		if ($path = Kohana::find_file('classes', $file)) 
		{ 
			// Load the class file 
			require $path; 

			// Class has been found 
			return TRUE; 
		} 

		// Class is not in the filesystem 
		return FALSE; 
	} 

	spl_autoload_register( 'freshbooks_auto_load' );

	$config = Kohana::$config->load( 'freshbooks' );

	FreshBooks_HttpClient::init(
		$config->get( 'api.url'),
		$config->get( 'api.auth_token')
	);
	
	define( 'MODULE_FRESHBOOKS', TRUE );
}

