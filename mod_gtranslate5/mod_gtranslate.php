<?php
/**
* @version   $Id$
* @package   GTranslate
* @copyright Copyright (C) 2008-2025 GTranslate Inc. All rights reserved.
* @license   GNU/GPL v3 http://www.gnu.org/licenses/gpl.html
*/

defined('_JEXEC') or die('Restricted access');

require_once(dirname(__FILE__).'/helper.php');

$params = modGTranslateHelper::getParams($params);

require(Joomla\CMS\Helper\ModuleHelper::getLayoutPath('mod_gtranslate'));