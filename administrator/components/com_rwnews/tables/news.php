<?php
use Joomla\CMS\Table\Table;

defined('_JEXEC') or die;

class TableRwnewsNews extends Table
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
	public function __construct(JDatabaseDriver $db)
	{
		parent::__construct('#__rwnews_news', 'id', $db);
	}
    public function store($updateNulls = true)
    {
        return parent::store($updateNulls);
    }
    public function publish($pks = null, $state = 1, $userId = 0)
    {
        $k = $this->_tbl_key;
        $state = (int) $state;
        // Если первичные ключи не установлены, то проверяем ключ в текущем объекте.
        if (empty($pks))
        {
            if ($this->$k)
            {
                $pks = array($this->$k);
            }
            else
            {
                throw new RuntimeException(JText::sprintf('JLIB_DATABASE_ERROR_NO_ROWS_SELECTED'), 500);
            }
        }
        // Устанавливаем состояние для всех первичных ключей.
        foreach ($pks as $pk)
        {
            // Загружаем сообщение.
            if (!$this->load($pk))
            {
                throw new RuntimeException(JText::sprintf('COM_LICENSING_TABLE_ERROR_RECORD_LOAD'), 500);
            }
            $this->published = $state;
            // Сохраняем сообщение.
            if (!$this->store())
            {
                throw new RuntimeException(JText::sprintf('COM_LICENSING_TABLE_ERROR_RECORD_STORE'), 500);
            }
        }
        return true;
    }
}