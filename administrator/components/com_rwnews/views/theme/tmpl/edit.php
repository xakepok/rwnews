<?php
defined('_JEXEC') or die;
JHtml::_('behavior.formvalidation');
JHtml::_('formbehavior.chosen', 'select');

use Joomla\CMS\HTML\HTMLHelper;

HTMLHelper::_('script', $this->script, array('version' => 'auto'));
HTMLHelper::_('stylesheet', 'com_rwnews/style.css', array('version' => 'auto', 'relative' => true));
?>
<script type="text/javascript">
    Joomla.submitbutton = function (task) {
        if (task === 'theme.cancel' || document.formvalidator.isValid(document.id('adminForm'))) {*/
            Joomla.submitform(task, document.getElementById('adminForm'));
        }
    }
</script>
<form action="<?php echo RwnewsHelper::getActionUrl(); ?>"
      method="post" name="adminForm" id="adminForm" xmlns="http://www.w3.org/1999/html" class="form-validate">
    <div class="row-fluid">
        <div class="span12 form-horizontal">
            <?php echo JHtml::_('bootstrap.startTabSet', 'myTab', array('active' => 'general')); ?>
            <div class="tab-content">
                <?php echo JHtml::_('bootstrap.addTab', 'myTab', 'general', JText::sprintf('COM_RWNEWS_MENU_ADD_THEME')); ?>
                <div class="row-fluid">
                    <div class="span6">
                        <div>
                            <?php echo $this->loadTemplate('general'); ?>
                        </div>
                    </div>
                    <div class="span6">
                        <div>

                        </div>
                    </div>
                </div>
                <?php echo JHtml::_('bootstrap.endTab'); ?>
            </div>
            <?php echo JHtml::_('bootstrap.endTabSet'); ?>
        </div>
        <div>
            <input type="hidden" name="task" value=""/>
            <?php echo JHtml::_('form.token'); ?>
        </div>
    </div>
</form>

