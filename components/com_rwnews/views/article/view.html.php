<?php
use Joomla\CMS\MVC\View\HtmlView;

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
        if ($this->item->id == null) {
            $this->_layout = 'error';
            return;
        }
        $this->setDocumentTitle($this->item->title);
    }
}
