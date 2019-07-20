<?php
use Joomla\CMS\MVC\View\HtmlView;

defined('_JEXEC') or die;

class RwnewsViewThemes extends HtmlView
{
	protected $helper;
	protected $sidebar = '';
	public $items, $pagination, $uid, $state, $links, $filterForm, $activeFilters;

	public function display($tpl = null)
	{
	    $this->items = $this->get('Items');
	    $this->pagination = $this->get('Pagination');
	    $this->state = $this->get('State');
        $this->filterForm = $this->get('FilterForm');
        $this->activeFilters = $this->get('ActiveFilters');

        // Show the toolbar
		$this->toolbar();

		// Show the sidebar
		$this->helper = new RwnewsHelper();
		$this->helper->addSubmenu('themes');
		$this->sidebar = JHtmlSidebar::render();

		// Display it all
		return parent::display($tpl);
	}

	private function toolbar()
	{
		JToolBarHelper::title(JText::sprintf('COM_RWNEWS_MENU_THEMES'), '');

        if (RwnewsHelper::canDo('core.create'))
        {
            JToolbarHelper::addNew('theme.add');
        }
        if (RwnewsHelper::canDo('core.edit'))
        {
            JToolbarHelper::editList('theme.edit');
        }
        if (RwnewsHelper::canDo('core.delete'))
        {
            JToolbarHelper::deleteList('COM_RWNEWS_QUESTION_DELETE_THEME', 'themes.delete');
        }
		if (RwnewsHelper::canDo('core.admin'))
		{
			JToolBarHelper::preferences('com_rwnews');
		}
	}
}
