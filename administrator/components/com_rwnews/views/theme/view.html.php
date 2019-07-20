<?php
defined('_JEXEC') or die;
use Joomla\CMS\MVC\View\HtmlView;

class RwnewsViewTheme extends HtmlView {
    protected $item, $form, $script, $id, $isAdmin, $fieldset;

    public function display($tmp = null) {
        $this->form = $this->get('Form');
        $this->item = $this->get('Item');
        $this->script = $this->get('Script');

        $this->addToolbar();
        $this->setDocument();

        parent::display($tmp);
    }

    protected function addToolbar() {
        JFactory::getApplication()->input->set('hidemainmenu', true);
        $title = $this->item->title ?? JText::sprintf('COM_RWNEWS_MENU_ADD_THEME');

        JToolbarHelper::title($title, '');
	    JToolBarHelper::apply('theme.apply', 'JTOOLBAR_APPLY');
        JToolbarHelper::save('theme.save', 'JTOOLBAR_SAVE');
        JToolbarHelper::cancel('theme.cancel', 'JTOOLBAR_CLOSE');
    }

    protected function setDocument() {
        JHtml::_('bootstrap.framework');
    }
}