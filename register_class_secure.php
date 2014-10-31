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

global $lepton_filemanager;
if (!is_object($lepton_filemanager)) require_once( "../../framework/class.lepton.filemanager.php" );


$files_to_register = array(
	'/modules/dirlist/save.php',	
	'/modules/dirlist/delete.php',
	'/modules/dirlist/modify.php',
	'/modules/dirlist/add.php'
);

$lepton_filemanager->register( $files_to_register );

?>