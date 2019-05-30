<?php
defined('_JEXEC') or die;
?>
<ul class="nav justify-content-end">
    <?php foreach ($this->item->assets as $asset) :?>
        <li class="nav-item">
            <a class="nav-link" href="<?php echo $asset['url'];?>"><?php echo $asset['text'];?></a>
        </li>
    <?php endforeach; ?>
</ul>
