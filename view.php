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
require_once(LEPTON_PATH.'/modules/dirlist/info.php');

if(!file_exists(LEPTON_PATH .'/modules/dirlist/languages/' .LANGUAGE .'.php')) {
	require_once(LEPTON_PATH .'/modules/dirlist/languages/EN.php');
} else {
		require_once(LEPTON_PATH .'/modules/dirlist/languages/' .LANGUAGE .'.php');
}

if(!function_exists('register_frontend_modfiles') && file_exists(LEPTON_PATH .'/modules/dirlist/frontend.css')) {
	echo '<style type="text/css">';
	include(LEPTON_PATH .'/modules/dirlist/frontend.css');
	echo "\n</style>\n";
}

$lib = get_included_files();
foreach ($lib as $value) { $library[] = basename($value); }
if (!in_array('class.parser.php',$library)) {
  require_once(LEPTON_PATH.'/modules/dirlist/class.parser.php'); }

require_once(LEPTON_PATH.'/modules/dirlist/class.dirlist.php');
require_once(LEPTON_PATH.'/modules/dirlist/class.mimetypes.php');

//error_reporting(E_ALL);

$dirlist = new dirlist($page_id,$section_id);
$dirlist->dlgView();

?>