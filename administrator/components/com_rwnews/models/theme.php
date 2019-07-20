<?php
defined('_JEXEC') or die;
use Joomla\CMS\MVC\Model\AdminModel;

class RwnewsModelTheme extends AdminModel {
    public function getTable($name = 'Themes', $prefix = 'TableRwnews', $options = array())
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

        if ($item->id == null) {
            $item->authorID = JFactory::getUser()->id;
        }
        return $item;
    }

    public function getForm($data = array(), $loadData = true)
    {
        $form = $this->loadForm(
            $this->option.'.theme', 'theme', array('control' => 'jform', 'load_data' => $loadData)
        );
        if (empty($form))
        {
            return false;
        }
        return $form;
    }

    protected function loadFormData()
    {
        $data = JFactory::getApplication()->getUserState($this->option.'.edit.theme.data', array());
        if (empty($data))
        {
            $data = $this->getItem();
        }

        return $data;
    }

    public function save($data)
    {
        $result = parent::save($data);
        return $result;
    }

    protected function prepareTable($table)
    {
        $nulls = array(); //Поля, которые NULL
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
            return $user->authorise('core.edit.state', $this->option . '.theme.' . (int) $record->id);
        }
        else
        {
            return parent::canEditState($record);
        }
    }

    public function getScript()
    {
        return 'administrator/components/' . $this->option . '/models/forms/theme.js';
    }
}