<?php
/**
* @version   $Id$
* @package   GTranslate
* @copyright Copyright (C) 2008-2010 Edvard Ananyan. All rights reserved.
* @license   GNU/GPL, see LICENSE.php
*/

defined( '_JEXEC' ) or die( 'Restricted access' );

jimport('joomla.application.component.controller');

class GTranslateController extends JController {
    function __construct($default = array()) {
        parent::__construct($default);
        $this->registerTask('edit', 'editCache');
        $this->registerTask('save', 'saveCache');
        $this->registerTask('apply', 'saveCache');
        $this->registerTask('remove', 'removeCache');
        $this->registerTask('refresh', 'refreshCache');
        $this->registerTask('purge', 'purgeCache');
    }

    function showCache() {
        global $mainframe, $option;

        $db               = &JFactory::getDBO();
        $filter_order     = $mainframe->getUserStateFromRequest("$option.filter_order",'filter_order','m.id');
        $filter_order_Dir = $mainframe->getUserStateFromRequest("$option.filter_order_Dir",'filter_order_Dir','');
        $filter_lang      = $mainframe->getUserStateFromRequest("$option.filter_lang",'filter_lang',0);
        $search           = $mainframe->getUserStateFromRequest("$option.search",'search','');
        $search           = $db->getEscaped(trim(JString::strtolower($search)));

        $limit      = JRequest::getVar('global.list.limit',$mainframe->getCfg('list_limit'),'','int');
        $limitstart = $mainframe->getUserStateFromRequest($option.'limitstart','limitstart',0);

        $where = array();

        if($filter_lang)
          $where[] = "m.lang = '$filter_lang'";
        if($search)
            $where[] = 'LOWER(m.url) LIKE "%'.$search.'%"';

        $where   = (count($where) ? ' WHERE ' . implode( ' AND ', $where ) : '' );
        $orderby = ' ORDER BY '. $filter_order .' '. $filter_order_Dir;

        $query = 'SELECT COUNT(m.id) FROM #__gtranslate as m ' . $where;
        $db->setQuery($query);
        $total = $db->loadResult();

        jimport('joomla.html.pagination');
        $pageNav = new JPagination($total,$limitstart,$limit);

        $query = 'SELECT m.* FROM #__gtranslate as m '.$where.' '.$orderby;
        $db->setQuery($query, $pageNav->limitstart, $pageNav->limit);
        $rows = $db->loadObjectList();

        foreach($rows as $k => $row) {
            $row->url = htmlspecialchars($row->url);
            if(strlen($row->url) > 70)
                $row->url = substr($row->url, 0, 70).'...';
            $rows[$k] = $row;
        }

        if($db->getErrorNum()) {
            echo $db->stderr();
            return false;
        }

        // lang filter
        $lang_array = array('en'=>'English','ar'=>'Arabic','bg'=>'Bulgarian','zh-CN'=>'Chinese (Simplified)','zh-TW'=>'Chinese (Traditional)','hr'=>'Croatian','cs'=>'Czech','da'=>'Danish','nl'=>'Dutch','fi'=>'Finnish','fr'=>'French','de'=>'German','el'=>'Greek','hi'=>'Hindi','it'=>'Italian','ja'=>'Japanese','ko'=>'Korean','no'=>'Norwegian','pl'=>'Polish','pt'=>'Portuguese','ro'=>'Romanian','ru'=>'Russian','es'=>'Spanish','sv'=>'Swedish','ca'=>'Catalan','tl'=>'Filipino','iw'=>'Hebrew','id'=>'Indonesian','lv'=>'Latvian','lt'=>'Lithuanian','sr'=>'Serbian','sk'=>'Slovak','sl'=>'Slovenian','uk'=>'Ukrainian','vi'=>'Vietnamese','sq'=>'Albanian','et'=>'Estonian','gl'=>'Galician','hu'=>'Hungarian','mt'=>'Maltese','th'=>'Thai','tr'=>'Turkish','fa'=>'Persian','af'=>'Afrikaans','ms'=>'Malay','sw'=>'Swahili','ga'=>'Irish','cy'=>'Welsh','be'=>'Belarusian','is'=>'Icelandic','mk'=>'Macedonian','yi'=>'Yiddish');
        asort($lang_array);
        $lang[] = JHTML::_('select.option',  '', '- '. JText::_( 'Select Lang' ) .' -' );
        foreach($lang_array as $k => $v)
            $lang[] = JHTML::_('select.option', $k, JText::_( $v ) );
        $lists['lang'] = JHTML::_('select.genericlist', $lang, 'filter_lang', 'class="inputbox" size="1" onchange="submitform( );"', 'value', 'text', $filter_lang);

        // table ordering
        $lists['order_Dir'] = $filter_order_Dir;
        $lists['order']     = $filter_order;

        // search filter
        $lists['search'] = $search;

        GTranslateView::showCache($rows,$pageNav,$option,$lists);
    }

    function editCache() { // TODO: load cache from file
        $db     = &JFactory::getDBO();
        $cid    = JRequest::getVar('cid',array(0),'','array');
        $option = JRequest::getVar('option');
        $uid    = (int) @$cid[0];

        $query = 'SELECT * FROM #__gtranslate WHERE id = '.$uid;
        $db->setQuery($query);
        $row = $db->loadObject();

        GTranslateView::editCache($row);
    }

    function saveCache() {
        $db     = &JFactory::getDBO();
        $post   = JRequest::get('post');
        $cid    = JRequest::getVar('cid',array(0),'','array');
        $cacheid = (int) @$cid[0];

        jimport('joomla.application.component.helper');
        $config = JComponentHelper::getParams('com_gtranslate');

        $cache_dir = is_dir($config->get('cache_dir')) ? $config->get('cache_dir') : JPATH_ROOT.DS.$config->get('cache_dir');

        $db->setQuery("select * from #__gtranslate where id = $cacheid");
        $cache = $db->loadObject();
        $cached_file = md5($cache->url).'.gz';

        //die(stripslashes($_POST['content']));

        $content = '<!-- Request: '.$cache->url." -->\n";
        $content .= stripslashes($_POST['content']);
        $gz = gzopen($cache_dir.DS.$cached_file, 'w9');
        gzwrite($gz, $content);
        gzclose($gz);

        switch($this->_task) {
            case 'apply':
                $msg = JText::_('Changes to cache saved');
                $link = 'index.php?option=com_gtranslate&task=edit&cid[]='. $cacheid .'';
                break;

            case 'save':
            default:
                $msg = JText::_('Cache saved');
                $link = 'index.php?option=com_gtranslate';
                break;
        }

        $this->setRedirect($link, $msg);
    }

    function removeCache() {
        $db     = &JFactory::getDBO();
        $cid    = JRequest::getVar( 'cid', array(), '', 'array' );
        $option = JRequest::getVar( 'option', 'com_gtranslate', '', 'string' );
        $msg = '';

        jimport('joomla.application.component.helper');
        $config = JComponentHelper::getParams('com_gtranslate');

        $cache_dir = is_dir($config->get('cache_dir')) ? $config->get('cache_dir') : JPATH_ROOT.DS.$config->get('cache_dir');

        for($i=0, $n=count($cid); $i < $n; $i++) {
            $db->setQuery("select * from #__gtranslate where id = $cid[$i]");
            $cache = $db->loadObject();
            $cached_file = md5($cache->url).'.gz';
            if(!unlink($cache_dir.DS.$cached_file))
                $msg .= "Cannot remove ". $cache_dir.DS.$cached_file;
            else {
                $msg .= "Cache with id: $cid[$i] successfully deleted";
                $query = "delete from #__gtranslate where id = $cid[$i]";
                $db->setQuery($query);
                $db->query();
            }
        }

        $this->setRedirect('index.php?option='.$option, $msg);
    }

    function refreshCache() {
        $db = &JFactory::getDBO();
        $db->setQuery('truncate #__gtranslate');
        $db->query();

        jimport('joomla.application.component.helper');
        $config = JComponentHelper::getParams('com_gtranslate');

        $cache_dir = is_dir($config->get('cache_dir')) ? $config->get('cache_dir') : JPATH_ROOT.DS.$config->get('cache_dir');

        $cached_files = array_diff(scandir($cache_dir), array('.', '..'));
        foreach($cached_files as $cached_file) {
            $handle = gzopen($cache_dir.DS.$cached_file, 'r');
            $request = gzgets($handle);
            sscanf($request, '<!-- Request: %s -->', $request);
            gzclose($handle);

            preg_match('/(\/[a-z]{2}\/)|(\/zh-TW\/)|(\/zh-CN\/)/', $request, $matches);

            if(isset($matches[0]))
                $lang = trim($matches[0], '/');

            $date = date('Y-m-d H:i:s', filemtime($cache_dir.DS.$cached_file));

            $db->setQuery("insert into #__gtranslate (lang, url, date) value('$lang', '".mysql_real_escape_string($request)."', '$date')");
            $db->query();
        }

        $this->setRedirect('index.php?option=com_gtranslate', 'Cache refreshed');
    }

    function purgeCache() {
        $db = &JFactory::getDBO();

        jimport('joomla.application.component.helper');
        $config = JComponentHelper::getParams('com_gtranslate');

        $cache_dir = is_dir($config->get('cache_dir')) ? $config->get('cache_dir') : JPATH_ROOT.DS.$config->get('cache_dir');

        $cache_time = 20*24*60*60;
        $now = time();
        $db->setQuery('select * from #__gtranslate');
        $rows = $db->loadObjectList();
        $count = 0;
        $size = 0;
        foreach($rows as $row) {
            $cached_file = $cache_dir.DS.md5($row->url).'.gz';
            if(is_file($cached_file) and $now - filemtime($cached_file) > 1.5 * $cache_time) {
                $file_size = filesize($cached_file);
                if(unlink($cached_file)) {
                    $db->setQuery('delete from #__gtranslate where id = '.$row->id);
                    $db->query();
                    $count++;
                    $size += $file_size;
                }
            }
        }

        $this->setRedirect('index.php?option=com_gtranslate', 'Cache purged: '. $count .' files have been deleted in total of ' . round($size/1024/1024, 2) . ' MBytes');
    }
}


class GTranslateView {

    function showCache(&$rows,&$pageNav,$option,&$lists) {
        JHTML::_('behavior.tooltip');
        ?>
        <form action="index.php?option=com_gtranslate" method="post" name="adminForm">

        <table>
        <tr>
            <td align="left" width="100%">
                <?php echo JText::_( 'Filter' ); ?>:
                <input type="text" name="search" id="search" value="<?php echo $lists['search'];?>" class="text_area" onchange="document.adminForm.submit();" />
                <button onclick="this.form.submit();"><?php echo JText::_( 'Go' ); ?></button>
                <button onclick="document.getElementById('search').value='';this.form.submit();"><?php echo JText::_( 'Reset' ); ?></button>
            </td>
            <td nowrap="nowrap">
                <?php
                echo $lists['lang'];
                ?>
            </td>
        </tr>
        </table>

        <div id="tablecell">
            <table class="adminlist">
            <thead>
                <tr>
                    <th width="1%">
                        <?php echo JText::_( 'NUM' ); ?>
                    </th>
                    <th width="2%">
                        <input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count( $rows ); ?>);" />
                    </th>
                    <th width="4%" class="title">
                        <?php echo JHTML::_('grid.sort', 'Lang', 'm.lang', @$lists['order_Dir'], @$lists['order']); ?>
                    </th>
                    <th width="70%" align="center">
                        <?php echo JHTML::_('grid.sort', 'Request', 'm.url', @$lists['order_Dir'], @$lists['order']); ?>
                    </th>
                    <th width="9%" align="center">
                        <?php echo JHTML::_('grid.sort', 'Date', 'm.date', @$lists['order_Dir'], @$lists['order']); ?>
                    </th>
                    <th width="1%" nowrap="nowrap">
                        <?php echo JHTML::_('grid.sort', 'ID', 'm.id', @$lists['order_Dir'], @$lists['order']); ?>
                    </th>
                </tr>
            </thead>
            <?php
            $k = 0;
            for ($i=0, $n=count( $rows ); $i < $n; $i++) {
                $row = &$rows[$i];

                $link        = JRoute::_('index.php?option=com_gtranslate&task=edit&cid[]='. $row->id);
                $checked     = JHTML::_('grid.checkedout',$row,$i);
                ?>
                <tr class="<?php echo "row$k"; ?>">
                    <td>
                        <?php echo $pageNav->getRowOffset( $i ); ?>
                    </td>
                    <td>
                        <?php echo $checked; ?>
                    </td>
                    <td align="center">
                        <a href="<?php echo $link; ?>" title="<?php echo JText::_( 'Edit Cache' ); ?>">
                            <?php echo $row->lang; ?></a>
                    </td>
                    <td align="left">
                        <?php echo $row->url; ?>
                    </td>
                    <td align="center">
                        <?php echo $row->date; ?>
                    </td>
                    <td align="center">
                        <?php echo $row->id; ?>
                    </td>
                </tr>
                <?php
                $k = 1 - $k;
            }
            ?>
            <tfoot>
                <td colspan="8">
                    <?php echo $pageNav->getListFooter(); ?>
                </td>
            </tfoot>
            </table>
        </div>

        <input type="hidden" name="option" value="<?php echo $option;?>" />
        <input type="hidden" name="task" value="" />
        <input type="hidden" name="boxchecked" value="0" />
        <input type="hidden" name="filter_order" value="<?php echo $lists['order']; ?>" />
        <input type="hidden" name="filter_order_Dir" value="" />
        </form>
        <?php
    }

    function editCache(&$row) { // TODO:
        //jimport('joomla.filter.output');
        //JFilterOutput::objectHTMLSafe($row,ENT_QUOTES);
        //$editor = &JFactory::getEditor();
        ?>
        <script language="javascript" type="text/javascript">
        function submitbutton(pressbutton) {
            var form = document.adminForm;
            submitform(pressbutton);
        }
        </script>
        <form action="index.php" method="post" name="adminForm">

        <fieldset class="adminform">
            <legend><?php echo JText::_('Cache Editor'); ?></legend>

            <table class="admintable">
            <tr>
                <td>
                    <?php
                    jimport('joomla.application.component.helper');
                    $config = JComponentHelper::getParams('com_gtranslate');

                    $cache_dir = is_dir($config->get('cache_dir')) ? $config->get('cache_dir') : JPATH_ROOT.DS.$config->get('cache_dir');

                    $cached_file = md5($row->url).'.gz';
                    ob_start();
                    readgzfile($cache_dir.DS.$cached_file);
                    $content = ob_get_contents();
                    ob_end_clean();
                    $content = substr($content, strpos($content, "\n"), strlen($content));
                    echo $row->url;
                    ?>
                    <p><textarea name="content" id="content" cols="120" rows="25"><?php echo $content; ?></textarea></p>
                    <?php
                    //echo $editor->display( 'content',  $content , '1000', '500', '80', '25');
                    ?>
                </td>
            </tr>
            </table>
        </fieldset>

        <div class="clr"></div>

        <input type="hidden" name="task" value="" />
        <input type="hidden" name="option" value="com_gtranslate" />
        <input type="hidden" name="id" value="<?php echo $row->id; ?>" />
        <input type="hidden" name="cid[]" value="<?php echo $row->id; ?>" />
        <input type="hidden" name="textfieldcheck" value="<?php echo @$n; ?>" />
        </form>
        <?php
    }
}

$controller = new GTranslateController(array('default_task' => 'showCache'));

$task = JRequest::getVar('task');
$controller->execute(JRequest::getVar('task'));
$controller->redirect();