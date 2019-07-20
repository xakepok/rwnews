<?php
use Joomla\CMS\MVC\Model\ListModel;

defined('_JEXEC') or die;

class RwnewsModelArticles extends ListModel
{
    public function __construct($config = array())
    {
        if (empty($config['filter_fields']))
        {
            $config['filter_fields'] = array(
                'n.id',
                'n.title',
                'category',
                'n.dat',
                'n.published',
                'author',
            );
        }
        parent::__construct($config);
    }

    protected function _getListQuery()
    {
        $db =& $this->getDbo();
        $query = $db->getQuery(true);
        $query
            ->select("n.id, n.title, n.dat, n.published")
            ->select("c.title as category")
            ->select("u.name as author")
            ->from("`#__rwnews_news` n")
            ->leftJoin("`#__rwnews_categories` c on c.id = n.catID")
            ->leftJoin("`#__users` u on u.id = n.authorID");

        /* Фильтр */
        $search = $this->getState('filter.search');
        if (!empty($search)) {
            $search = $db->q("%{$search}%");
            $query->where("`n`.`title` LIKE {$search}");
        }

        //Фильтр по категории
        $category = $this->getState('filter.category');
        if (is_numeric($category)) {
            $category = $db->q($category);
            $query->where("n.catID = {$category}");
        }

        //Фильтр по автору
        $author = $this->getState('filter.author');
        if (is_numeric($author)) {
            $author = $db->q($author);
            $query->where("n.authorID = {$author}");
        }

        /* Сортировка */
        $orderCol  = $this->state->get('list.ordering');
        $orderDirn = $this->state->get('list.direction');
        $query->order($db->escape($orderCol . ' ' . $orderDirn));

        return $query;
    }

    public function getItems()
    {
        $items = parent::getItems();
        $result = array();
        if (empty($items)) return $result;
        foreach ($items as $item) {
            $arr = array();
            $arr['id'] = $item->id;
            $url = JRoute::_("index.php?option=com_rwnews&amp;task=article.edit&amp;id={$item->id}");
            $arr['title'] = JHtml::link($url, $item->title);
            $arr['category'] = $item->category;
            $arr['author'] = $item->author;
            $arr['dat'] = JDate::getInstance($item->dat)->format("d.m.Y H:i");
            $arr['published'] = (bool) $item->published;
            $result[] = $arr;
        }
        return $result;
    }

    /* Сортировка по умолчанию */
    protected function populateState($ordering = 'n.dat', $direction = 'desc')
    {
        $search = $this->getUserStateFromRequest($this->context . '.filter.search', 'filter_search');
        $this->setState('filter.search', $search);
        $category = $this->getUserStateFromRequest($this->context . '.filter.category', 'filter_category');
        $this->setState('filter.category', $category);
        $author = $this->getUserStateFromRequest($this->context . '.filter.author', 'filter_author');
        $this->setState('filter.author', $author);
        parent::populateState($ordering, $direction);
    }

    protected function getStoreId($id = '')
    {
        $id .= ':' . $this->getState('filter.search');
        $id .= ':' . $this->getState('filter.category');
        $id .= ':' . $this->getState('filter.author');
        return parent::getStoreId($id);
    }
}
