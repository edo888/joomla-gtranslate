<?php
/**
* @version   $Id$
* @package   GTranslate
* @copyright Copyright (C) 2008-2012 Edvard Ananyan. All rights reserved.
* @license   GNU/GPL v3 http://www.gnu.org/licenses/gpl.html
*/

defined('_JEXEC') or die('Restricted access');

class JElementGTranslateHeadbar extends JElement {

	var	$_name = 'GTranslateHeadbar';

	function fetchTooltip() {
		return;
	}

	function fetchElement($name, $value, &$node) {
		$this->_ = $_SERVER['HTTP_HOST'];

		$app = &JFactory::getApplication();

		$html = '<div style="float:left;padding:10px 0 0 10px"><a target="_blank" href="http://gtranslate.net/" alt="Author: Perfect-Web"><img src="http://gtranslate.net/templates/gtranslate/images/gt_logo_joomla.png" alt="GTranslate"></a></div>
<div class="toolbar">
	<table class="toolbar">
	<tr>
		<td class="button">
			<a class="toolbar" rel="help" onclick="popupWindow(\'http://gtranslate.net/documentation/mod_gtranslate_j15\', \'Documentation\', 700, 500, 1)" href="#">
			<span class="icon-32-help"></span>Documentation</a>
		</td>
	</tr>
	</table>
</div>
<div class="clr"></div>';

        //TODO: update notification <iframe width="1" height="1" frameborder="0" src=""></iframe>

		return $html;
	}
}