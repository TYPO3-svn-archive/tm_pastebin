<?php
/***************************************************************
*  Copyright notice
*
*  (c) 2010 Tomita Militaru <mail@tomitamilitaru.com>
*  All rights reserved
*
*  This script is part of the TYPO3 project. The TYPO3 project is
*  free software; you can redistribute it and/or modify
*  it under the terms of the GNU General Public License as published by
*  the Free Software Foundation; either version 2 of the License, or
*  (at your option) any later version.
*
*  The GNU General Public License can be found at
*  http://www.gnu.org/copyleft/gpl.html.
*
*  This script is distributed in the hope that it will be useful,
*  but WITHOUT ANY WARRANTY; without even the implied warranty of
*  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
*  GNU General Public License for more details.
*
*  This copyright notice MUST APPEAR in all copies of the script!
***************************************************************/
/**
 * [CLASS/FUNCTION INDEX of SCRIPT]
 *
 * Hint: use extdeveval to insert/update function index above.
 */

require_once(PATH_tslib.'class.tslib_pibase.php');


/**
 * Plugin 'PasteBin URL Generator' for the 'tm_pastebin' extension.
 *
 * @author	Tomita Militaru <mail@tomitamilitaru.com>
 * @package	TYPO3
 * @subpackage	tx_tmpastebin
 */
class tx_tmpastebin_pi1 extends tslib_pibase {
	var $prefixId      = 'tx_tmpastebin_pi1';		// Same as class name
	var $scriptRelPath = 'pi1/class.tx_tmpastebin_pi1.php';	// Path to this script relative to the extension dir.
	var $extKey        = 'tm_pastebin';	// The extension key.
	var $pi_checkCHash = true;
	
	/**
	 * The main method of the PlugIn
	 *
	 * @param	string		$content: The PlugIn content
	 * @param	array		$conf: The PlugIn configuration
	 * @return	The content that is displayed on the website
	 */
	function main($content, $conf) {
		$this->conf = $conf;
		$this->pi_setPiVarDefaults();
		$this->pi_loadLL();
    $extKey = 'tm_pastebin';
    $content = '';
		
    $isSubmit = t3lib_div::_GP('submit_paste');
    if(isset($isSubmit)){
      $fields = 'paste_code=' . t3lib_div::_GP('paste_code') . 
        '&paste_format=' . t3lib_div::_GP('paste_format') . 
        '&paste_expire_date=' . t3lib_div::_GP('paste_expire_date') .
        '&paste_private=' . t3lib_div::_GP('paste_private') .
        '&paste_subdomain=' . t3lib_div::_GP('paste_subdomain') .
        '&paste_name=' . t3lib_div::_GP('paste_name') .
        '&paste_email=' . t3lib_div::_GP('paste_email');
      $url = "http://pastebin.com/api_public.php";
      
      $ch = curl_init($url);
      curl_setopt($ch, CURLOPT_HEADER, 0);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
      curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
      $response = strip_tags(curl_exec($ch));
      curl_close ($ch);
      $content = '
      <div class="' . $extKey . '-result">' .
      'PasteBin URL:<br /> <a href="' . $response . '">' . $response . '</a>' .
      '</div>';
    } else {
	
		$content .='
		<div class="' . $extKey . '">
		<form name="paste_form" method="post" action="" id="paste_form">
    Paste Text: <br />
    <textarea cols="50" rows="5" name="paste_code">
    </textarea><br />
    Syntax highlighting: <i>(optional)</i><br />
    <select class="post_select" name="paste_format">
      <option value="bash">
        Bash
      </option>

      <option value="c">
        C
      </option>

      <option value="cpp">
        C++
      </option>

      <option value="css">
        CSS
      </option>

      <option value="html4strict">
        HTML
      </option>

      <option value="java">
        Java
      </option>

      <option value="javascript">
        JavaScript
      </option>

      <option value="lua">
        Lua
      </option>

      <option value="text" selected="selected">
        None
      </option>

      <option value="perl">
        Perl
      </option>

      <option value="php">
        PHP
      </option>

      <option value="python">
        Python
      </option>

      <option value="rails">
        Rails
      </option>

      <option value="0">
        ----------------------------
      </option>

      <option value="abap">
        ABAP
      </option>

      <option value="actionscript">
        ActionScript
      </option>

      <option value="ada">
        Ada
      </option>

      <option value="apache">
        Apache Log File
      </option>

      <option value="applescript">
        AppleScript
      </option>

      <option value="asm">
        ASM (NASM based)
      </option>

      <option value="asp">
        ASP
      </option>

      <option value="autoit">
        AutoIt
      </option>

      <option value="bash">
        Bash
      </option>

      <option value="blitzbasic">
        Blitz Basic
      </option>

      <option value="bnf">
        BNF
      </option>

      <option value="c">
        C
      </option>

      <option value="c_mac">
        C for Macs
      </option>

      <option value="csharp">
        C#
      </option>

      <option value="cpp">
        C++
      </option>

      <option value="caddcl">
        CAD DCL
      </option>

      <option value="cadlisp">
        CAD Lisp
      </option>

      <option value="cfm">
        ColdFusion
      </option>

      <option value="css">
        CSS
      </option>

      <option value="d">
        D
      </option>

      <option value="delphi">
        Delphi
      </option>

      <option value="dff">
        Diff
      </option>

      <option value="dos">
        DOS
      </option>

      <option value="eiffel">
        Eiffel
      </option>

      <option value="erlang">
        Erlang
      </option>

      <option value="fortran">
        Fortran
      </option>

      <option value="freebasic">
        FreeBasic
      </option>

      <option value="gml">
        Game Maker
      </option>

      <option value="genero">
        Genero
      </option>

      <option value="groovy">
        Groovy
      </option>

      <option value="haskell">
        Haskell
      </option>

      <option value="html4strict">
        HTML
      </option>

      <option value="ini">
        INI file
      </option>

      <option value="inno">
        Inno Script
      </option>

      <option value="java">
        Java
      </option>

      <option value="javascript">
        JavaScript
      </option>

      <option value="latex">
        Latex
      </option>

      <option value="lsl2">
        Linden Scripting Language
      </option>

      <option value="lisp">
        Lisp
      </option>

      <option value="lua">
        Lua
      </option>

      <option value="m68k">
        M68000 Assembler
      </option>

      <option value="matlab">
        MatLab
      </option>

      <option value="matlab">
        MatLab
      </option>

      <option value="mirc">
        mIRC
      </option>

      <option value="mpasm">
        MPASM
      </option>

      <option value="mysql">
        MySQL
      </option>

      <option value="text">
        None
      </option>

      <option value="nsis">
        NullSoft Installer
      </option>

      <option value="objc">
        Objective C
      </option>

      <option value="ocaml">
        OCaml
      </option>

      <option value="oobas">
        Openoffice.org BASIC
      </option>

      <option value="oracle8">
        Oracle 8
      </option>

      <option value="pascal">
        Pascal
      </option>

      <option value="perl">
        Perl
      </option>

      <option value="php">
        PHP
      </option>

      <option value="plswl">
        PL/SQL
      </option>

      <option value="python">
        Python
      </option>

      <option value="qbasic">
        QBasic/QuickBASIC
      </option>

      <option value="rails">
        Rails
      </option>

      <option value="robots">
        Robots
      </option>

      <option value="ruby">
        Ruby
      </option>

      <option value="scheme">
        Scheme
      </option>

      <option value="smalltalk">
        Smalltalk
      </option>

      <option value="smarty">
        Smarty
      </option>

      <option value="sql">
        SQL
      </option>

      <option value="tcl">
        TCL
      </option>

      <option value="tcl">
        TCL
      </option>

      <option value="unreal">
        unrealScript
      </option>

      <option value="vbnet">
        VB.NET
      </option>

      <option value="vb">
        VisualBasic
      </option>

      <option value="visualfoxpro">
        VisualFoxPro
      </option>

      <option value="xml">
        XML
      </option>

      <option value="z80">
        Z80 Assembler
      </option>
    </select><br />
    Post expiration: <i>(optional)</i><br />
    <select name="paste_expire_date">
      <option value="N">
        Never
      </option>

      <option value="10M">
        10 Minutes
      </option>

      <option value="1H">
        1 Hour
      </option>

      <option value="1D">
        1 Day
      </option>

      <option value="1M">
        1 Month
      </option>
    </select><br />
    Post exposure: <i>(optional)</i><br />
    <select name="paste_private">
      <option value="0">
        Public
      </option>

      <option value="1">
        Private
      </option>
    </select><br />
    Subdomain: <i>(optional)</i><br />
    <input type="text" name="paste_subdomain" size="20" value="" /><br />
    Name / Title: <i>(optional)</i><br />
    <input type="text" name="paste_name" size="20" value="" /><br />
    Email: <i>(optional)</i><br />
    <input type="text" name="paste_email" size="20" value="" /><br />
    <input type="submit" value="submit" name="submit_paste" />
    </form>
    </div>
		';
		}
	
		return $this->pi_wrapInBaseClass($content);
	}
}



if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/tm_pastebin/pi1/class.tx_tmpastebin_pi1.php'])	{
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/tm_pastebin/pi1/class.tx_tmpastebin_pi1.php']);
}

?>