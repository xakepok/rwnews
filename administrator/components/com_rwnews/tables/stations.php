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
}