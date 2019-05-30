<?php
defined('_JEXEC') or die;
?>
<ul class="nav justify-content-end">
    <?php foreach ($this->item->links as $link) :?>
        <li class="nav-item">
            <a class="nav-link" href="<?php echo $link['url'];?>"><?php echo $link['text'];?></a>
        </li>
    <?php endforeach; ?>
</ul>
