<?php

/**
 *  @module         DirList
 *  @version        see info.php of this module
 *  @authors        Ralf Hertsch (&#x271D;), cms-lab
 * 	@copyright		2007 - 2012 Ralf Hertsch (&#x271D;)
 *  @copyright      2013-2014 cms-lab 
 *  @license        MIT License (MIT) http://www.opensource.org/licenses/MIT
 *  @license terms  see info.php of this module
 *
 */

// include class.secure.php to protect this file and the whole CMS!
if ( defined( 'LEPTON_PATH' ) )
{
	include( LEPTON_PATH . '/framework/class.secure.php' );
} //defined( 'LEPTON_PATH' )
else
{
	$oneback = "../";
	$root    = $oneback;
	$level   = 1;
	while ( ( $level < 10 ) && ( !file_exists( $root . '/framework/class.secure.php' ) ) )
	{
		$root .= $oneback;
		$level += 1;
	} //( $level < 10 ) && ( !file_exists( $root . '/framework/class.secure.php' ) )
	if ( file_exists( $root . '/framework/class.secure.php' ) )
	{
		include( $root . '/framework/class.secure.php' );
	} //file_exists( $root . '/framework/class.secure.php' )
	else
	{
		trigger_error( sprintf( "[ <b>%s</b> ] Can't include class.secure.php!", $_SERVER[ 'SCRIPT_NAME' ] ), E_USER_ERROR );
	}
}
// end include class.secure.php

$module_directory 	 = 'dirlist';
$module_name 		 = 'DirList';
$module_function 	 = 'page';
$module_version 	 = '0.24';
$module_platform 	 = '1.x';
$module_status       = 'Stable';
$module_author 		 = 'Ralf Hertsch (&#x271D;), cms-lab';
$module_license 	 = 'MIT License (MIT)';
$module_description  = 'Show files of a selected MEDIA directory with mime-type icon, name, size and date of last change for download.';
$module_home         = 'http://cms-lab.com';
$module_guid         = 'DC9E87CA-0D9E-47E0-9CF1-9CBFF6EFD31C';

/**
 *  changelog:
 *  https://github.com/labby/dirlist
 *
 */

?>