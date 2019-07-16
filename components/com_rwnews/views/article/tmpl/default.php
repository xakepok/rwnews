<?php
use Joomla\CMS\HTML\HTMLHelper;

defined('_JEXEC') or die;

HTMLHelper::_('script', 'com_rwnews/script.js', array('version' => 'auto', 'relative' => true));
HTMLHelper::_('stylesheet', 'com_rwnews/style.css', array('version' => 'auto', 'relative' => true));
?>
<div class="row">
    <div class="col">
        <h2><?php echo $this->item->title;?></h2>
        <div>
            <?php if ($this->item->img_full): ?>
                <img <?php if (!RwnewsHelper::isMobile()):?> class="float-left"<?php endif;?><?php if (RwnewsHelper::isMobile()):?> class="w-100"<?php endif;?> style="margin: 5px" src="<?php echo JRoute::_($this->item->image);?>" alt="<?php echo $this->item->title;?>" />
            <?php endif;?>
            <div style="word-wrap: break-word;"><?php echo $this->item->text;?></div>
            <div class="text-right">
                <?php echo JText::sprintf("%s, %s", $this->item->user, JDate::getInstance($this->item->dat)->format("d.m.Y"));?>
            </div>
        </div>
        <div class="row">
            <div class="col xs-12">
                <?php echo $this->loadTemplate('links');?>
            </div>
        </div>
        <div class="row">
            <div class="col xs-12">
                <?php echo $this->loadTemplate('assets');?>
            </div>
        </div>
    </div>
</div>
