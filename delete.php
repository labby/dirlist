<?php

/**
 *  @module         DirList
 *  @version        see info.php of this module
 *  @authors        Ralf Hertsch (†), cms-lab
 *  @copyright      2007 - 2012 Ralf Hertsch (†)
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

// Modul Informationen
require_once('info.php');

if(!file_exists(LEPTON_PATH .'/modules/dirlist/languages/' .LANGUAGE .'.php')) {
	require_once(LEPTON_PATH .'/modules/dirlist/languages/DE.php');
} else {
		require_once(LEPTON_PATH .'/modules/dirlist/languages/' .LANGUAGE .'.php');
}

require_once('class.dirlist.php');

$dirlist = new sql_dirlist();

if (!$dirlist->sql_deleteEntry($section_id)) {
  $admin->print_error(sprintf(dl_error_delete_record,$dirlist->errorPlace,$dirlist->error));
}

?>