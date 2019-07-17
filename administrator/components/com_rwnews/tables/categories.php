<?php
use Joomla\CMS\Table\Table;

defined('_JEXEC') or die;

class TableRwnewsCategories extends Table
{
    var $id = null;
    var $title = null;
    var $published = null;
	public function __construct(JDatabaseDriver $db)
	{
		parent::__construct('#__rwnews_categories', 'id', $db);
	}

	public static function getInstance($type = 'Categories', $prefix = 'TableRwnews', $config = array())
    {
        return parent::getInstance($type, $prefix, $config);
    }
}