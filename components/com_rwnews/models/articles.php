<?php
use Joomla\CMS\MVC\Model\ListModel;

defined('_JEXEC') or die;

class RwnewsModelArticles extends ListModel
{
    public function __construct($config = array())
    {
        $input = JFactory::getApplication()->input;
        $this->categoryID = $input->getInt('categoryID', 0);
        parent::__construct($config);
    }

    protected function _getListQuery()
    {
        $db =& $this->getDbo();
        $query = $db->getQuery(true);
        $query
            ->select("n.id, n.title, n.dat, n.img_prev")
            ->from("`#__rwnews_news` n")
            ->leftJoin("`#__rwnews_categories` c on c.id = n.catID")
            ->leftJoin("`#__users` u on u.id = n.authorID")
            ->where("n.published = 1");

        //Фильтр по категории
        if ($this->categoryID > 0) {
            $query->where("n.catID = {$this->categoryID}");
        }

        return $query;
    }

    public function getItems()
    {
        $items = parent::getItems();
        $result = array();
        if (empty($items)) return $result;
        $itemID = RwHelper::getMenuItemId('article');
        foreach ($items as $item) {
            $arr = array();
            $arr['id'] = $item['id'];
            $arr['img'] = $item->img_prev;
            $url = JRoute::_("index.php?option=com_rwnews&amp;view=article&amp;id={$item->id}&amp;Itemid={$itemID}");
            $arr['title'] = JHtml::link($url, $item->title);
            $result[] = $arr;
        }
        return $result;
    }

    public function getCategoryID(): int
    {
        return $this->categoryID;
    }

    private $categoryID;
}