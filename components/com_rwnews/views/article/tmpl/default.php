<?php
use Joomla\CMS\HTML\HTMLHelper;

defined('_JEXEC') or die;

HTMLHelper::_('script', 'com_rwnews/script.js', array('version' => 'auto', 'relative' => true));
HTMLHelper::_('stylesheet', 'com_rwnews/style.css', array('version' => 'auto', 'relative' => true));
?>

<div>
    <h2><?php echo $this->item->title;?></h2>
    <?php echo JText::sprintf("%s, %s", $this->item->user, JDate::getInstance($this->item->dat)->format("d.m.Y"));?>
</div>
<?php if ($this->item->img_full): ?>
<div class="center">
    <img src="<?php echo JRoute::_($this->item->image);?>" alt="<?php echo $this->item->title;?>" />
</div>
<?php endif;?>
<div>
    <?php echo $this->item->text;?>
</div>
<div style="text-align: right;">
    <?php echo $this->item->links;?>
</div>
