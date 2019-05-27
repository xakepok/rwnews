<?php
defined('_JEXEC') or die;
JHtml::_('behavior.multiselect');
JHtml::_('formbehavior.chosen', 'select');
JHtml::_('searchtools.form');

use Joomla\CMS\HTML\HTMLHelper;

HTMLHelper::_('stylesheet', 'com_rwnews/style.css', array('version' => 'auto', 'relative' => true));
HTMLHelper::_('script', 'com_rwnews/script.js', array('version' => 'auto', 'relative' => true));
?>
<div class="row-fluid">
    <div id="j-sidebar-container" class="span2">
        <form action="<?php echo $this->helper->getSidebarAction(); ?>" method="post">
            <?php echo $this->sidebar; ?>
        </form>
    </div>
    <div id="j-main-container" class="span10">
        <form action="<?php echo $this->helper->getActionUrl(); ?>" method="post"
              name="adminForm" id="adminForm">
            <?php echo JLayoutHelper::render('joomla.searchtools.default', array('view' => $this)); ?>
            <table class="table table-striped">
                <thead><?php echo $this->loadTemplate('head'); ?></thead>
                <tbody><?php echo $this->loadTemplate('body'); ?></tbody>
                <tfoot><?php echo $this->loadTemplate('foot'); ?></tfoot>
            </table>
            <input type="hidden" name="task" value=""/>
            <input type="hidden" name="boxchecked" value="0"/>
        </form>
    </div>
</div>
