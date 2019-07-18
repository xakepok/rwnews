<?php
use Joomla\CMS\MVC\View\HtmlView;
use Joomla\Utilities\ArrayHelper;

defined('_JEXEC') or die;

class RwnewsViewArticle extends HtmlView
{
    protected $item;
    public function display($tpl = null)
    {
        $this->item = $this->get('Item');
        $this->prepare();
        return parent::display($tpl);
    }

    private function prepare(): void
    {
        if ($this->item->id == null || $this->item->published !== '1') {
            $this->_layout = 'error';
            return;
        }
        $this->setDocumentTitle($this->item->title);
        $itemID = RwHelper::getMenuItemID('news', 'com_rwnews');
        $menu = JFactory::getApplication()->getMenu();
        $url = JRoute::_("index.php?option=com_rwnews&amp;view=articles&amp;Itemid={$itemID}");
        $items = array();
        $items[] = array('name' => $menu->getItem($itemID)->title, 'link' => $url);
        $items[] = array('name' => $this->item->title);
        $items = ArrayHelper::toObject($items);
        JFactory::getApplication()->getPathway()->setPathway($items);
    }
}
