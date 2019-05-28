<?php
use Joomla\CMS\Table\Table;

defined('_JEXEC') or die;

class TableRwnewsRwnews extends Table
{
    var $id = null;
    var $catID = null;
    var $authorID = null;
    var $title = null;
    var $text = null;
    var $dat = null;
    var $img_prev = null;
    var $img_full = null;
    var $link_original = null;
    var $link_group = null;
    var $published = null;
    var $category = null;
    var $user = null;
	public function __construct(JDatabaseDriver $db)
	{
		parent::__construct('#__rwnews', 'id', $db);
	}
}