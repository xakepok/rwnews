<?php
use Joomla\CMS\MVC\Model\ListModel;

defined('_JEXEC') or die;

class RwnewsModelArticles extends ListModel
{
    public function __construct($config = array())
    {
        $input = JFactory::getApplication()->input;
        $this->categoryID = $input->getInt('categoryID', 0);
        $this->themeID = $input->getInt('themeID', 0);
        parent::__construct($config);
    }

    protected function _getListQuery()
    {
        $config = JComponentHelper::getParams($this->option);
        $db =& $this->getDbo();
        $query = $db->getQuery(true);
        $query
            ->select("n.id, n.title, n.dat, n.img_prev")
            ->from("`#__rwnews_news` n")
            ->leftJoin("`#__rwnews_categories` c on c.id = n.catID")
            ->leftJoin("`#__users` u on u.id = n.authorID")
            ->where("(n.published = 1 and ((n.date_start is null or n.date_start < current_timestamp) and (n.date_end is null or n.date_end > current_timestamp)))")
            ->order("n.dat desc");

        //Отрезаем превью
        if ((bool) $config->get('show_prev')) {
            $length = (int) $config->get('prev_length', 0);
            $check = $length - 3;
            $query->select("IF(LENGTH(fnStripTags(n.text)) > {$check},substring(fnStripTags(n.text),1,{$length}),fnStripTags(n.text)) as `prev`");
        }

        //Фильтр по категории
        if ($this->categoryID > 0) {
            $query->where("n.catID = {$this->categoryID}");
        }

        //Фильтр по категории
        if ($this->themeID > 0) {
            $query->where("n.themeID = {$this->themeID}");
        }

        return $query;
    }

    public function getItems()
    {
        $items = parent::getItems();
        $result = array();
        if (empty($items)) return $result;
        $config = JComponentHelper::getParams($this->option);
        $itemID = RwHelper::getMenuItemId('article', $this->option);
        foreach ($items as $item) {
            $arr = array();
            $arr['id'] = $item->id;
            $url = JRoute::_("index.php?option=com_rwnews&amp;view=article&amp;id={$item->id}&amp;Itemid={$itemID}");
            $arr['url'] = $url;
            $arr['img'] = $item->img_prev;
            $arr['alt'] = $item->title;
            $arr['title'] = JHtml::link($url, $item->title);

            //Отрезаем превью
            if ((bool) $config->get('show_prev')) {
                $words = explode(" ", $item->prev);
                if (count($words) > 2) {
                    $words[count($words) - 2] .= "...";
                    unset($words[count($words) - 1]);
                    $arr['prev'] = implode(" ", $words);
                }
                else {
                    $arr['prev'] = $item->prev;
                }
            }
            $result[] = $arr;
        }
        return $result;
    }

    public function getCategoryTitle(): string
    {
        if ($this->categoryID === 0) return '';
        $table = $this->getTable('Categories', 'TableRwnews');
        $table->load($this->categoryID);
        return $table->title ?? '';
    }

    public function getCategoryID(): int
    {
        return $this->categoryID;
    }

    private $categoryID, $themeID;
}