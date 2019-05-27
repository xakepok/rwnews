<?php
defined('_JEXEC') or die;
use Joomla\CMS\MVC\Model\AdminModel;

class RwnewsModelArticle extends AdminModel {
    public function getTable($name = 'News', $prefix = 'TableRwnews', $options = array())
    {
        return JTable::getInstance($name, $prefix, $options);
    }

    public function delete(&$pks)
    {
        return parent::delete($pks);
    }

    public function getItem($pk = null)
    {
        $item = parent::getItem($pk);
        if ($item->id != null) {
            $item->stations = array_unique(RwnewsHelper::getNewsStations($item->id ?? 0));
        }
        return $item;
    }

    public function getForm($data = array(), $loadData = true)
    {
        $form = $this->loadForm(
            $this->option.'.article', 'article', array('control' => 'jform', 'load_data' => $loadData)
        );
        if (empty($form))
        {
            return false;
        }
        return $form;
    }

    protected function loadFormData()
    {
        $data = JFactory::getApplication()->getUserState($this->option.'.edit.article.data', array());
        if (empty($data))
        {
            $data = $this->getItem();
            $data->authorID = JFactory::getUser()->id;
        }

        return $data;
    }

    public function save($data)
    {
        $result = parent::save($data);
        $id = $data['id'] ?? JFactory::getDbo()->insertid();
        $s1 = $this->saveStations($id, $data['stations'] ?? array());
        return $result && $s1;
    }

    /**
     * Сохраняет привязку новости к станциям
     * @param int $newsID ID новости
     * @param array $ids массив с ID станций
     * @return bool true в случае успешного сохранения данных, false в случае ошибки
     * @since version 1.0.0.2
     * @throws
     */
    private function saveStations(int $newsID = 0, array $ids = array()): bool
    {
        $ids = array_unique($ids);
        sort($ids);
        if ($newsID == 0) return false;
        $already = RwnewsHelper::getNewsStations($newsID);
        sort($already);
        $model = AdminModel::getInstance('Station', 'RwnewsModel');
        $del = array_diff($already, $ids);
        $insert = array_diff($ids, $already);
        foreach ($del as $station) {
            $s = $model->getItem(array('newsID' => $newsID, 'stationID' => $station));
            if ($s->id != null) {
                if (!$model->delete($s->id)) {
                    JFactory::getApplication()->enqueueMessage(JText::sprintf('COM_RWNEWS_ERROR_DELETE_NEWS_STATION', $station), 'error');
                    return false;
                }
            }
        }
        foreach ($insert as $id) {
            $arr = array('id' => null, 'newsID' => $newsID, 'stationID' => $id);
            $table = $model->getTable('Stations', 'TableRwnews');
            $table->bind($arr);
            if (!$table->store(true)) {
                JFactory::getApplication()->enqueueMessage(JText::sprintf('COM_RWNEWS_ERROR_SAVE_NEWS_STATION', $id), 'error');
                return false;
            }
        }
        return true;
    }

    protected function prepareTable($table)
    {
        $nulls = array('text', 'img_prev', 'img_full'); //Поля, которые NULL
        foreach ($nulls as $field)
        {
            if (!strlen($table->$field)) $table->$field = NULL;
        }
        parent::prepareTable($table);
    }

    protected function canEditState($record)
    {
        $user = JFactory::getUser();

        if (!empty($record->id))
        {
            return $user->authorise('core.edit.state', $this->option . '.article.' . (int) $record->id);
        }
        else
        {
            return parent::canEditState($record);
        }
    }

    public function getScript()
    {
        return 'administrator/components/' . $this->option . '/models/forms/article.js';
    }
}