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

class templateParser
{
	 var $data = array();
   var $html = "";

	 /**
	 * Initializes "macro=>value" array
	 * @param Array "macro=>value" array
	 * @return none
	 */
   function initData($data,$resetHTML=true)
   {
      $this->data = array();
      $this->data = $data;
      if ($resetHTML) unset($this->html);
   }

   /**
	 * Parses template file
	 * @param template filename
	 * @return parsed template
	 */
   function parseTemplateFile($templateFile)
   {
      $searchPattern          = "/\{([a-zA-Z0-9_]+)\}/i"; // macro delimiter "{" and "}"
      $replacementFunction    = array(&$this, 'parseMatchedText');  //Method callbacks are performed this way
      $fileData               = file_get_contents($templateFile);
      $this->html            .= preg_replace_callback($searchPattern, $replacementFunction, $fileData);
      return $this->html;
   }

   /**
	 * Parses template data
	 * @param template data
	 * @return parsed data
	 */
   function parseTemplateData($templateData)
   {
      $searchPattern          = "/\{([a-zA-Z0-9_]+)\}/i"; //macro delimiter "{" and "}"
      $replacementFunction    = array(&$this, 'parseMatchedText');  //Method callbacks are performed this way
      $this->html         		= preg_replace_callback($searchPattern, $replacementFunction, $templateData);
      return $this->html;
   }

   /**
   * Callback function that returns value of a matching macro
   * @param Array $matches
   * @return String value of matching macro
   */
   function parseMatchedText($matches)
   {
      return $this->data[$matches[1]];
   }

  function encodeSpecialChars(&$value) {
  	$value = str_replace("ä","&auml;",$value);
  	$value = str_replace("Ä","&Auml;",$value);
  	$value = str_replace("ö","&ouml;",$value);
  	$value = str_replace("Ö","&Ouml;",$value);
  	$value = str_replace("ü","&uuml;",$value);
  	$value = str_replace("Ü","&Uuml;",$value);
  	$value = str_replace("ß","&szlig;",$value);
  	$value = str_replace("€","&euro;",$value);
    return $value;
  }

  function decodeSpecialChars(&$value) {
   	$value = str_replace("&auml;","ä",$value);
   	$value = str_replace("&Auml;","Ä",$value);
   	$value = str_replace("&ouml;","ö",$value);
   	$value = str_replace("&Ouml;","Ö",$value);
   	$value = str_replace("&uuml;","ü",$value);
   	$value = str_replace("&Uuml;","Ü",$value);
   	$value = str_replace("&szlig;","ß",$value);
   	$value = str_replace("&euro;","€",$value);
    return $value;
  }

  /**
  *	F�gt dem "macro=>value" Array Werte hinzu und maskiert Sonderzeichen f�r die HTML Ausgabe
  * @param string $key Schl�ssel
  * @param string $value Wert
  * @param boolean $encode=true Sonderzeichen maskieren
  */
	function add($key,$value,$encode=true) {
  	$encode ?	$this->data[$key]=$this->encodeSpecialChars($value) : $this->data[$key]=$value;
  }

  /**
   * Entfernt einen Wert aus dem "macro=>value" Array
   *
   * @param string $key
   */
  function delete($key) {
    unset($this->data[$key]);
  }

  /**
   * Setzt das "macro=>value" Array zur�ck
   *
   */
  function clear($resetHTML=false) {
  	$this->data = array();
    if ($resetHTML) unset($this->html);
  }

  function echoHTML($resetHTML=true) {
  	echo $this->html;
    if ($resetHTML) unset($this->html);
  }

  function getHTML($resetHTML=true) {
   	$result = $this->html;
    if ($resetHTML) unset($this->html);
    return $result;
  }

} //End Of Class

?>