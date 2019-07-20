<?php
defined('_JEXEC') or die;
$listOrder    = $this->escape($this->state->get('list.ordering'));
$listDirn    = $this->escape($this->state->get('list.direction'));
?>
<tr>
    <th style="width: 1%;">
        <?php echo JHtml::_('grid.checkall'); ?>
    </th>
    <th style="width: 5%;">
        <?php echo JHtml::_('grid.sort', 'JSTATUS', 't.published', $listDirn, $listOrder); ?>
    </th>
    <th>
        <?php echo JHtml::_('searchtools.sort', 'COM_RWNEWS_HEAD_TITLE', 't.title', $listDirn, $listOrder); ?>
    </th>
    <th>
        <?php echo JHtml::_('searchtools.sort', 'COM_RWNEWS_HEAD_AUTHOR', 'u.name', $listDirn, $listOrder); ?>
    </th>
    <th style="width: 1%;">
        <?php echo JHtml::_('searchtools.sort', 'ID', 't.id', $listDirn, $listOrder); ?>
    </th>
</tr>