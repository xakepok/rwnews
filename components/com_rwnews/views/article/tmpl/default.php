<?php
use Joomla\CMS\HTML\HTMLHelper;

defined('_JEXEC') or die;

HTMLHelper::_('script', 'com_rwnews/script.js', array('version' => 'auto', 'relative' => true));
HTMLHelper::_('stylesheet', 'com_rwnews/style.css', array('version' => 'auto', 'relative' => true));
?>
<div class="row">
    <div class="col">
        <h2><?php echo $this->item->title;?></h2>
        <div class="text-muted">
            <?php echo JText::sprintf("%s, %s", JDate::getInstance($this->item->dat)->format("d.m.Y"), $this->item->user);?>
        </div>
        <div>
            <?php if ($this->item->img_full): ?>
                <img <?php if (!RwnewsHelper::isMobile()):?> class="float-left"<?php endif;?><?php if (RwnewsHelper::isMobile()):?> class="w-100"<?php endif;?> style="margin: 5px" src="<?php echo JRoute::_($this->item->image);?>" alt="<?php echo $this->item->title;?>" />
            <?php endif;?>
            <div style="word-wrap: break-word;"><?php echo $this->item->text;?></div>
        </div>
        <div class="row">
            <div class="col-lg-8 xs-12">
                <?php echo $this->item->other;?>
            </div>
            <div class="col-lg-4 xs-12">
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
