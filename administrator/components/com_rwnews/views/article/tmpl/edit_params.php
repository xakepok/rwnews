<?php
defined('_JEXEC') or die;
?>
<fieldset class="adminform">
    <div class="control-group form-inline">
        <?php foreach ($this->form->getFieldset('params') as $field) :
            echo $field->renderField();
        endforeach; ?>
    </div>
</fieldset>
<fieldset class="adminform">
    <div class="control-group form-inline">
        <?php foreach ($this->form->getFieldset('publish') as $field) :
            echo $field->renderField();
        endforeach; ?>
    </div>
</fieldset>
