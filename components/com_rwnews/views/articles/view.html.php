<?php
use Joomla\CMS\MVC\View\HtmlView;

defined('_JEXEC') or die;

class RwnewsViewArticles extends HtmlView
{
    protected $categoryID, $categoryTitle, $items;
    public function display($tpl = null)
    {
        $this->categoryID = $this->get('CategoryID');
        if ($this->categoryID > 0) {
            $this->categoryTitle = $this->get('CategoryTitle');
        }
        $this->items = $this->get('Items');
        $this->prepare();
        return parent::display($tpl);
    }

    private function prepare(): void
    {
        /*if ($this->item->id == null) {
            $this->_layout = 'error';
            return;
        }
        $this->setDocumentTitle($this->item->title);*/
    }
}
