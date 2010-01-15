<?php
/**
* @version   $Id$
* @package   GTranslate
* @copyright Copyright (C) 2008-2010 Edvard Ananyan. All rights reserved.
* @license   GNU/GPL, see LICENSE.php
*/

defined( '_JEXEC' ) or die( 'Restricted access' );

class TOOLBAR_GTranslate {
    function _DEFAULT() {
        JToolBarHelper::title(  JText::_( 'GTranslate Cache Manager' ) );
        $document =& JFactory::getDocument();
        $document->addStyleDeclaration('.icon-32-refresh {background-image:url(templates/khepri/images/toolbar/icon-32-refresh.png) !important;}');
        JToolBarHelper::editList();
        JToolBarHelper::deleteList();
        JToolBarHelper::custom('refresh', 'refresh.png', 'refresh.png', 'Refresh', '', false);
        JToolBarHelper::custom('purge', 'trash.png', 'trash.png', 'Purge Expired Cache', '', false);
        JToolBarHelper::preferences('com_gtranslate', '550');
    }

    function _EDIT($applid) {
        $cid = JRequest::getVar('cid', array(0));

        $text = ( $cid[0] ? JText::_( 'Edit' ) : JText::_( 'New' ) );

        JToolBarHelper::title(  JText::_( 'GTranslate Cache Manager' ).': <small><small>[ '.$text.' ]</small></small>' );
        JToolBarHelper::save();
        JToolBarHelper::apply();
        if($cid[0])
            JToolBarHelper::cancel('cancel', 'Close');
        else
            JToolBarHelper::cancel();
    }
}