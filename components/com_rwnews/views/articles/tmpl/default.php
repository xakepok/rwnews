<?php
use Joomla\CMS\HTML\HTMLHelper;

defined('_JEXEC') or die;

HTMLHelper::_('script', 'com_rwnews/script.js', array('version' => 'auto', 'relative' => true));
HTMLHelper::_('stylesheet', 'com_rwnews/style.css', array('version' => 'auto', 'relative' => true));
$width = RwnewsHelper::getParam('prev_img_width', 100);
$height = RwnewsHelper::getParam('prev_img_height', 70);
?>
<h4><?php echo ($this->categoryID > 0) ? $this->categoryTitle : JText::sprintf('COM_RWNEWS_TITLE_LATEST_NEWS');?></h4>
<?php
for ($i = 0; $i < count($this->items); $i++): ?>
    <div class="row">
        <?php for($j = 0; $j < 2; $j++): ?>
            <div class="col-lg-6">
                <div class="media">
                    <?php if (!RwnewsHelper::isMobile()): ?>
                        <img src="<?php echo $this->items[$i]['img'];?>" alt="<?php echo $this->items[$i]['alt'];?>" class="align-self-top mr-3" height="<?php echo $height;?>" />
                    <?php endif;?>
                    <?php if (RwnewsHelper::isMobile()): ?>
                        <img src="<?php echo $this->items[$i]['img'];?>" alt="<?php echo $this->items[$i]['alt'];?>" class="align-self-top mr-3" width="<?php echo $width;?>" />
                    <?php endif;?>
                    <div class="media-body">
                        <h6 class="mt-0"><?php echo $this->items[$i]['title'];?></h6>
                        <?php echo $this->items[$i]['prev'];?>
                    </div>
                </div>
            </div>
            <?php if ($j == 0) $i++;?>
        <?php endfor;?>
    </div>
<?php endfor;?>



