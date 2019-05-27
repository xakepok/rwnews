<?php
use Joomla\CMS\MVC\Model\ItemModel;

defined('_JEXEC') or die;

class RwnewsModelArticle extends ItemModel
{
    public function __construct($config = array())
    {
        $this->id = JFactory::getApplication()->input->getInt('id', 0);
        parent::__construct($config);
    }

    public function getTable($name = 'News', $prefix = 'TableRwnews', $options = array())
    {
        return parent::getTable($name, $prefix, $options);
    }

    public function getItem(): object
    {
        $table = $this->getTable();
        $table->load($this->id);
        $table->image = (!JFactory::getApplication()->client->mobile) ? $table->img_full : $table->img_prev;
        return $table;
    }

    public $id;
}
