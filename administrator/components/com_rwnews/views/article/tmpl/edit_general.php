<?php
defined('_JEXEC') or die;
?>
<fieldset class="adminform">
    <div class="form-group">
        <?php foreach ($this->form->getFieldset('general') as $field) :
            echo $field->renderField();
        endforeach; ?>
    </div>
</fieldset>
