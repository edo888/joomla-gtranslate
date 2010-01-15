<?php
/**
* @version   $Id$
* @package   GTranslate
* @copyright Copyright (C) 2008-2010 Edvard Ananyan. All rights reserved.
* @license   GNU/GPL, see LICENSE.php
*/

defined( '_JEXEC' ) or die( 'Restricted access' );

require_once(JApplicationHelper::getPath('toolbar_html'));

switch($task) {
    case 'edit':
        $cid = JRequest::getVar('cid', array(0), '', 'array');
        if(!is_array($cid))
            $cid = array(0);
        TOOLBAR_GTranslate::_EDIT($cid[0]);
        break;

    default:
        TOOLBAR_GTranslate::_DEFAULT();
        break;
}