<?php
use Joomla\CMS\Table\Table;

defined('_JEXEC') or die;

class TableRwnewsStations extends Table
{
    var $id = null;
    var $newsID = null;
    var $stationID = null;
	public function __construct(JDatabaseDriver $db)
	{
		parent::__construct('#__rwnews_stations', 'id', $db);
	}

    public function bind($src, $ignore = array())
    {
        foreach ($src as $field => $value)
        {
            if (isset($this->$field)) $this->$field = $value;
        }
        return parent::bind($src, $ignore);
    }
}