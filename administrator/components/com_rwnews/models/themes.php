<?php
use Joomla\CMS\MVC\Model\ListModel;

defined('_JEXEC') or die;

class RwnewsModelThemes extends ListModel
{
    public function __construct($config = array())
    {
        if (empty($config['filter_fields']))
        {
            $config['filter_fields'] = array(
                'id',
                'title',
                'author', 'u.name',
                'published'
            );
        }
        parent::__construct($config);
    }

    protected function _getListQuery()
    {
        $db =& $this->getDbo();
        $query = $db->getQuery(true);
        $query
            ->select("t.id, t.title, t.published")
            ->select("u.name as author")
            ->from("`#__rwnews_themes` t")
            ->leftJoin("`#__users` u on u.id = t.authorID");

        /* Фильтр */
        $search = $this->getState('filter.search');
        if (!empty($search)) {
            $search = $db->q("%{$search}%");
            $query->where("t.title LIKE {$search}");
        }

        //Фильтр по автору
        $author = $this->getState('filter.author');
        if (is_numeric($author)) {
            $author = $db->q($author);
            $query->where("t.authorID = {$author}");
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
            $url = JRoute::_("index.php?option=com_rwnews&amp;task=theme.edit&amp;id={$item->id}");
            $arr['title'] = JHtml::link($url, $item->title);
            $arr['author'] = $item->author;
            $arr['published'] = (bool) $item->published;
            $result[] = $arr;
        }
        return $result;
    }

    /* Сортировка по умолчанию */
    protected function populateState($ordering = 'title', $direction = 'asc')
    {
        $search = $this->getUserStateFromRequest($this->context . '.filter.search', 'filter_search');
        $this->setState('filter.search', $search);
        $author = $this->getUserStateFromRequest($this->context . '.filter.author', 'filter_author');
        $this->setState('filter.author', $author);
        parent::populateState($ordering, $direction);
    }

    protected function getStoreId($id = '')
    {
        $id .= ':' . $this->getState('filter.search');
        $id .= ':' . $this->getState('filter.author');
        return parent::getStoreId($id);
    }
}
